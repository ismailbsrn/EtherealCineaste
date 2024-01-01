<?php
// Connect to the MySQL server
$mysqli = new mysqli("localhost", "root", "", "ethereal_cineaste");

// Check for errors
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Retrieve the notes from the MySQL database
$result = $mysqli->query("SELECT * FROM movie_reviews");

// Check for errors
if (!$result) {
    die("Failed to retrieve notes: " . $mysqli->error);
}

// Display the notes in an HTML table
echo "<table>";
echo "<tr><th>ID</th><th>Entry Date</th><th>Movie Name</th><th>Review Name</th><th>Content</th></tr>";

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $entry_date = $row['entry_date'];
    $movie_name = $row['movie_name'];
    $review_name = $row['review_name'];

    $content = html_entity_decode($row['content']); // Decode the contents to display in browser    

    echo "<tr>";
    echo "<td>$id</td>";
    echo "<td>$entry_date</td>";
    echo "<td>$movie_name</td>";
    echo "<td>$review_name</td>";
    echo "<td>$content</td>";
    echo "</tr>";
}

echo "</table>";
?>