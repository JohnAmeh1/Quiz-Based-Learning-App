<?php

header('Content-Type: application/json');

$apiKey = 'AIzaSyBIhV5pt5tJMMU153NT5WD1LFdGzAE4fWc'; // Replace with your YouTube API key
$query = $_GET['query'] ?? 'programming'; // Default search query
$maxResults = 90; // Number of videos to fetch

// Build the API URL
$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&q=$query+programming+tutorial&type=video&videoDuration=long&maxResults=$maxResults&key=$apiKey";

// Fetch data from YouTube API
$response = file_get_contents($url);

if ($response === FALSE) {
    echo json_encode(['error' => 'Failed to fetch videos']);
    exit;
}

echo $response;
