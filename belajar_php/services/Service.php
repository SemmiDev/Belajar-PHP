<?php

require_once('./utils/ConnectionUtil.php');

function query($sql)
{
	global $conn;
	$result = mysqli_query($conn, $sql);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data)
{
    global $conn;

    $name = htmlspecialchars($data["name"]);
    $identifier = htmlspecialchars($data["identifier"]);
    $email = htmlspecialchars($data["email"]);
    $phone = htmlspecialchars($data["phone"]);
    $major = htmlspecialchars($data["major"]);

    // upload image
    $image = upload($identifier);

    if (!$image) {return false;}

    $query = "INSERT INTO student(name,identifier,email,phone,major,image) VALUES ('$name','$identifier','$email','$phone','$major','$image')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function upload($identfier){

    $namaFile = $_FILES['image']['name'];
    $ukuranFile = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // cek apakah tidak ada image yang diupload
    if( $error === 4 ) {
        echo "<script>
				alert('pilih image terlebih dahulu!');
			  </script>";
        return false;
    }

    // cek apakah yang diupload adalah image
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
				alert('yang anda upload bukan image!');
			  </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 2000000 ) {
        echo "<script>
				alert('ukuran image terlalu besar!');
			  </script>";
        return false;
    }

    // lolos pengecekan, image siap diupload
    // generate nama image baru
    $namaFileBaru = $identfier;
    $namaFileBaru .= '-' . uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'images/' . $namaFileBaru);

    return $namaFileBaru;
}

function delete($id): int
{
    global $conn;
    mysqli_query($conn, "DELETE FROM student WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function change($data)
{
    global $conn;

    $id = htmlspecialchars($data["id"]);
    $name = htmlspecialchars($data["name"]);
    $identifier = htmlspecialchars($data["identifier"]);
    $email = htmlspecialchars($data["email"]);
    $phone = htmlspecialchars($data["phone"]);
    $major = htmlspecialchars($data["major"]);
    $oldImage = htmlspecialchars($data["oldImage"]);

    if( $_FILES['image']['error'] === 4 ) {
        $image = $oldImage;
    } else {
        $image = upload($identifier);
    }


    $query = "UPDATE student SET name = '$name', identifier = '$identifier', email = '$email', phone = '$phone', major = '$major', image='$image' where id='$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function search($keyword)
{
	$query = "SELECT * FROM student WHERE
			  name LIKE '%$keyword%' OR
			  identifier LIKE '%$keyword%' OR
			  email LIKE '%$keyword%' OR
			  phone LIKE '%$keyword%'
			";
	return query($query);
}

function signUp($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirm = mysqli_real_escape_string($conn, $data["confirm"]);

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    $resultEmail = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
        return false;
    }

    if( mysqli_fetch_assoc($resultEmail) ) {
        echo "<script>
				alert('email sudah terdaftar!')
		      </script>";
        return false;
    }

    if (!str_contains($email, ".") || !str_contains($email, "@")) {
        echo "<script>
				alert('email must valid!')
		      </script>";
        return false;
    }



    // cek konfirmasi password
    if( $password !== $confirm ) {
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
        return false;
    }

    if (strlen($password) < 8) {
        echo "<script>
				alert('password min 8 character!');
		      </script>";

        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user(username,email,password) VALUES('$username', '$email', '$password')");
    return mysqli_affected_rows($conn);
}