<?php
// Start session
session_start();

// Get the user type from session if available
$type = isset($_SESSION['user']['type']) ? $_SESSION['user']['type'] : '';

// Get the URI
$uri = $_SERVER['REQUEST_URI'];

// Define allowed folders for each user type
$allowedFolders = [
    'admin' => '',
    'parent' => 'parent',
    'enseignant' => ''
];

// Define excluded folders for 'enseignant' user type
$excludedFolders = [
    'parent'
];

// Check if the user is logged in
$userLoggedIn = isset($_SESSION['user']);

// Check if the user is authorized based on their type and requested URI
if ($userLoggedIn) {
    // Check if the user is an admin
    if ($type === 'admin') {
        // Admin has access to all paths
    } elseif ($type === 'parent') {
        // Parent has access to paths containing '/parent/'
        if (strpos($uri, '/parent/') === false) {
            header("Location: ../public/logout.php");
            exit();
        }
    } elseif ($type === 'enseignant') {
        // Enseignant has access to all paths except '/parent/'
        foreach ($excludedFolders as $folder) {
            if (strpos($uri, '/' . $folder . '/') !== false) {
                header("Location: ../public/logout.php");
                exit();
            }
        }
    }
} else {
    // If the user is not logged in and tries to access paths other than '/pedagogie/',
    // redirect to the login page
    if ((strpos($uri, '/pedagogie/') === false)&&(strpos($uri, '/card/') === false)&&(strpos($uri, '/service/') === false)) {
        header("Location: ../public/logout.php");
        exit();
    }
}
?>

<style>
    *{
    list-style: none;
   
}

  </style>