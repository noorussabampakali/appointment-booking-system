<?php
include("connection.php"); // Database connection

$doctorSuggestions = [];

// Placeholder for doctors' experience/qualifications for demonstration
$doctors = [
    ['name' => 'Dr. Smith', 'specialty' => 1, 'experience' => 10], // General Practice
    ['name' => 'Dr. Johnson', 'specialty' => 2, 'experience' => 5], // Cardiology
    ['name' => 'Dr. Brown', 'specialty' => 3, 'experience' => 8], // Respiratory Medicine
    ['name' => 'Dr. Wilson', 'specialty' => 1, 'experience' => 12], // General Practice
    ['name' => 'Dr. Taylor', 'specialty' => 2, 'experience' => 15], // Dermatology
];

// Initialize symptom arrays
$symptomsMapping = [
    'fever' => 1, // General Practice
    'chest_pain' => 2, // Cardiology
    'breathing_difficulty' => 3, // Respiratory Medicine
    'joint_pain' => 1, // General Practice
    'skin_rash' => 2, // Dermatology
];

$symptomsChecked = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve user's general selections, symptoms included in the post variables
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $symptoms = $_POST['symptoms'] ?? [];
    $specialtyIds = [];

    // Determine the corresponding specialties based on selected symptoms
    foreach ($symptoms as $symptom) {
        if (array_key_exists($symptom, $symptomsMapping)) {
            $specialtyIds[] = $symptomsMapping[$symptom];
            $symptomsChecked[$symptom] = true; // Keep track of checked symptoms
        }
    }

    // Fetch doctors based on selected specialties, prioritizing experience
    if (!empty($specialtyIds)) {
        $filteredDoctors = array_filter($doctors, function($doctor) use ($specialtyIds) {
            return in_array($doctor['specialty'], $specialtyIds);
        });

        // Sort doctors by experience in descending order
        usort($filteredDoctors, function($a, $b) {
            return $b['experience'] <=> $a['experience'];
        });

        foreach ($filteredDoctors as $doctor) {
            $doctorSuggestions[] = $doctor['name'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Feedback Quiz</title>
    <link rel="stylesheet" href="../css/main.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            text-align: center;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #007bff;
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        input[type="text"], select {
            width: calc(100% - 24px);
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }
        label {
            display: block;
            margin: 10px 0;
        }
        input[type="checkbox"] {
            margin-right: 10px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s, transform 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        input[type="submit"]:focus {
            outline: 2px solid #0056b3;
            outline-offset: 2px;
        }
        ul {
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }
        li {
            background: #007bff;
            color: white;
            padding: 12px;
            margin: 5px 0;
            border-radius: 5px;
            font-weight: bold;
        }
        .feedback {
            margin: 20px 0;
            font-size: 1.1em;
            color: #ff0000; /* Red for attention */
        }
        .login-register {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Health Feedback Quiz</h1>
        <form action="" method="POST">
            <p>Please provide some general information:</p>
            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required value="<?php echo htmlspecialchars($age ?? ''); ?>">

            <label for="gender">Gender:</label>
            <select id="gender" name="gender" required>
                <option value="">Select Gender</option>
                <option value="male" <?php echo (isset($gender) && $gender === 'male') ? 'selected' : ''; ?>>Male</option>
                <option value="female" <?php echo (isset($gender) && $gender === 'female') ? 'selected' : ''; ?>>Female</option>
                <option value="other" <?php echo (isset($gender) && $gender === 'other') ? 'selected' : ''; ?>>Other</option>
            </select>

            <p>Select any symptoms you are experiencing:</p>
            <label><input type="checkbox" name="symptoms[]" value="fever" <?php echo (isset($symptomsChecked['fever'])) ? 'checked' : ''; ?>> Fever</label>
            <label><input type="checkbox" name="symptoms[]" value="chest_pain" <?php echo (isset($symptomsChecked['chest_pain'])) ? 'checked' : ''; ?>> Chest Pain</label>
            <label><input type="checkbox" name="symptoms[]" value="breathing_difficulty" <?php echo (isset($symptomsChecked['breathing_difficulty'])) ? 'checked' : ''; ?>> Breathing Difficulty</label>
            <label><input type="checkbox" name="symptoms[]" value="joint_pain" <?php echo (isset($symptomsChecked['joint_pain'])) ? 'checked' : ''; ?>> Joint Pain</label>
            <label><input type="checkbox" name="symptoms[]" value="skin_rash" <?php echo (isset($symptomsChecked['skin_rash'])) ? 'checked' : ''; ?>> Skin Rash</label>
            <br>
            <input type="submit" value="Submit Feedback">
        </form>

        <?php if (!empty($doctorSuggestions)) : ?>
            <div>
                <h3>Recommended Doctors:</h3>
                <ul>
                    <?php foreach ($doctorSuggestions as $doctor) : ?>
                        <li><?php echo htmlspecialchars($doctor); ?></li>
                    <?php endforeach; ?>
                </ul>
                <!-- Instructions for logging in or registering -->
                <p class="login-register">Please <a href="login.php">login</a> or <a href="signup.php">register</a> to book an appointment with the recommended doctors.</p>
            </div>
        <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
            <p class="feedback">No doctor recommendations found based on your input.</p>
        <?php endif; ?>
    </div>
</body>
</html>