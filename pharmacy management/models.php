<?php
// ================================================================
// MODELS - All DB access using procedural mysqli + prepared stmts
// ================================================================

/* ------------------- Admin ------------------- */
function authAdmin($conn, $username, $password) {

    $stmt = mysqli_prepare($conn,
        "SELECT id, username, password FROM admins WHERE username = ?");

    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    mysqli_stmt_close($stmt);

    return ($row && password_verify($password, $row['password'])) ? $row : false;
}

/* ----------------- Pharmacist ----------------- */

function getLibrarians($conn) {

    $r = mysqli_query($conn,
        "SELECT id, name, contact, username
         FROM pharmacist
         ORDER BY id DESC");

    return mysqli_fetch_all($r, MYSQLI_ASSOC);
}

function getLibrarian($conn, $id) {

    $stmt = mysqli_prepare($conn,
        "SELECT id, name, contact, username
         FROM pharmacist
         WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    mysqli_stmt_close($stmt);

    return $row;
}

function addLibrarian($conn, $name, $contact, $username, $password) {

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn,
        "INSERT INTO pharmacist (name, contact, username, password)
         VALUES (?, ?, ?, ?)");

    mysqli_stmt_bind_param($stmt, 'ssss',
        $name,
        $contact,
        $username,
        $hash
    );

    $ok = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $ok;
}

function updateLibrarian($conn, $id, $name, $contact, $username) {

    $stmt = mysqli_prepare($conn,
        "UPDATE pharmacist
         SET name = ?, contact = ?, username = ?
         WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'sssi',
        $name,
        $contact,
        $username,
        $id
    );

    $ok = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $ok;
}

function deleteLibrarian($conn, $id) {

    $stmt = mysqli_prepare($conn,
        "DELETE FROM pharmacist WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'i', $id);

    $ok = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $ok;
}

function searchLibrarians($conn, $term) {

    $like = '%' . $term . '%';

    $stmt = mysqli_prepare($conn,
        "SELECT id, name, contact, username
         FROM pharmacist
         WHERE name LIKE ?
         OR username LIKE ?
         OR contact LIKE ?
         ORDER BY id DESC");

    mysqli_stmt_bind_param($stmt, 'sss',
        $like,
        $like,
        $like
    );

    mysqli_stmt_execute($stmt);

    $rows = mysqli_fetch_all(
        mysqli_stmt_get_result($stmt),
        MYSQLI_ASSOC
    );

    mysqli_stmt_close($stmt);

    return $rows;
}

function authLibrarian($conn, $username, $password) {

    $stmt = mysqli_prepare($conn,
        "SELECT id, name, username, password
         FROM pharmacist
         WHERE username = ?");

    mysqli_stmt_bind_param($stmt, 's', $username);

    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    mysqli_stmt_close($stmt);

    return ($row && password_verify($password, $row['password'])) ? $row : false;
}

function librarianUsernameExists($conn, $username, $excludeId = null) {

    if ($excludeId) {

        $stmt = mysqli_prepare($conn,
            "SELECT id
             FROM pharmacist
             WHERE username = ?
             AND id != ?");

        mysqli_stmt_bind_param($stmt, 'si',
            $username,
            $excludeId
        );

    } else {

        $stmt = mysqli_prepare($conn,
            "SELECT id
             FROM pharmacist
             WHERE username = ?");

        mysqli_stmt_bind_param($stmt, 's', $username);
    }

    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    $exists = mysqli_stmt_num_rows($stmt) > 0;

    mysqli_stmt_close($stmt);

    return $exists;
}

/* ------------------- Medicine ------------------- */

function getBooks($conn) {

    $r = mysqli_query($conn,
        "SELECT id, medicine_name, company, quantity, price
         FROM medicine
         ORDER BY id DESC");

    return mysqli_fetch_all($r, MYSQLI_ASSOC);
}

function getBook($conn, $id) {

    $stmt = mysqli_prepare($conn,
        "SELECT id, medicine_name, company, quantity, price
         FROM medicine
         WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);

    $row = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    mysqli_stmt_close($stmt);

    return $row;
}

function addBook($conn, $title, $author, $quantity, $price, $librarianId) {

    // Removed pharmacist_id from the column list and the VALUES list
    $stmt = mysqli_prepare($conn,
        "INSERT INTO medicine 
        (medicine_name, company, quantity, price) 
         VALUES (?, ?, ?, ?)");

    // Changed binding to 'ssid' (4 parameters instead of 5)
    mysqli_stmt_bind_param($stmt, 'ssid',
        $title,
        $author,
        $quantity,
        $price
    );

    $ok = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $ok;
}

function updateBook($conn, $id, $title, $author, $quantity, $price) {

    $stmt = mysqli_prepare($conn,
        "UPDATE medicine
         SET medicine_name = ?,
             company = ?,
             quantity = ?,
             price = ?
         WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'ssidi',
        $title,
        $author,
        $quantity,
        $price,
        $id
    );

    $ok = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $ok;
}

function deleteBook($conn, $id) {

    $stmt = mysqli_prepare($conn,
        "DELETE FROM medicine WHERE id = ?");

    mysqli_stmt_bind_param($stmt, 'i', $id);

    $ok = mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    return $ok;
}

function searchBooks($conn, $term) {

    $like = '%' . $term . '%';

    $stmt = mysqli_prepare($conn,
        "SELECT id, medicine_name, company, quantity, price
         FROM medicine
         WHERE medicine_name LIKE ?
         OR company LIKE ?
         ORDER BY id DESC");

    mysqli_stmt_bind_param($stmt, 'ss',
        $like,
        $like
    );

    mysqli_stmt_execute($stmt);

    $rows = mysqli_fetch_all(
        mysqli_stmt_get_result($stmt),
        MYSQLI_ASSOC
    );

    mysqli_stmt_close($stmt);

    return $rows;
}
?>