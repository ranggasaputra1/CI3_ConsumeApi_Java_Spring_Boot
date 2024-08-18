<!DOCTYPE html>
<html>
<head>
    <title>Update Lokasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container {
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container label {
            margin: 5px 0;
        }
        .form-container input,
        .form-container button {
            padding: 8px;
            margin: 5px 0;
        }
        .form-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Lokasi</h1>
        <div class="form-container">
            <form action="<?php echo site_url('HomeController/update_location'); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars(isset($location['id']) ? $location['id'] : ''); ?>">

                <label for="namaLokasi">Nama Lokasi:</label>
                <input type="text" id="namaLokasi" name="namaLokasi" value="<?php echo htmlspecialchars(isset($location['namaLokasi']) ? $location['namaLokasi'] : ''); ?>" required>

                <label for="negara">Negara:</label>
                <input type="text" id="negara" name="negara" value="<?php echo htmlspecialchars(isset($location['negara']) ? $location['negara'] : ''); ?>" required>

                <label for="provinsi">Provinsi:</label>
                <input type="text" id="provinsi" name="provinsi" value="<?php echo htmlspecialchars(isset($location['provinsi']) ? $location['provinsi'] : ''); ?>" required>

                <label for="kota">Kota:</label>
                <input type="text" id="kota" name="kota" value="<?php echo htmlspecialchars(isset($location['kota']) ? $location['kota'] : ''); ?>" required>

                <label for="createdAt">Created At:</label>
                <input type="datetime-local" name="createdAt" id="createdAt" value="<?php echo htmlspecialchars(isset($location['createdAt']) ? $location['createdAt'] : ''); ?>">

                <button type="submit">Update Lokasi</button>
            </form>
        </div>
    </div>
</body>
</html>
