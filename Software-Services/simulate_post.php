<?php
// Software-Services/simulate_post.php

// Mock POST data
$_SERVER['REQUEST_METHOD'] = 'POST';
$_POST = [
    'inquiry_type' => 'Service',
    'reference_name' => 'Simulation Test Service',
    'name' => 'Simulation User',
    'mobile' => '8888888888',
    'email' => 'simulation@test.com',
    'message' => 'This is a simulation test.'
];

// Run the handler
require 'ajax_submit_inquiry.php';
?>