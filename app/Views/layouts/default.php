<!-- app/Views/layouts/default.php -->
<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</head>
<body class="bg-white dark:bg-gray-900">
    <?= $this->renderSection('content') ?>
    <?= $this->include('partials/footer') ?>
</body>
</html>