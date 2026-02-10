<?php
// Software-Services/debug_admin_view.php

require 'admin/bootstrap.php';
use TrainingApp\App\Models\Enquiry;

echo "<h1>Admin View Debugger</h1>";

// 1. Fetch All
$list = Enquiry::filter([]);
echo "Total Inquiries Found: " . count($list) . "<br>";

// 2. Split Logic (Copied from admin/views/enquiries.php)
$course_inquiries = [];
$service_inquiries = [];

foreach ($list as $item) {
    if ($item['inquiry_type'] === 'Course') {
        $course_inquiries[] = $item;
    } else {
        $service_inquiries[] = $item;
    }
}

echo "<h2>Counts</h2>";
echo "Course Inquiries: " . count($course_inquiries) . "<br>";
echo "Service Inquiries: " . count($service_inquiries) . "<br>";

echo "<h2>Service Inquiries Data</h2>";
echo "<pre>";
print_r($service_inquiries);
echo "</pre>";
?>