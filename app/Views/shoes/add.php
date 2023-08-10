<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/navb') ?>

<h2 class="ml-10 mt-4 text-xl font-semibold leading-none text-gray-900 md:text-2xl dark:text-white">Add a shoe</h2>
<form action="/news/create" method="post" class="ml-9 mr-16 mt-7" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="mb-6">
        <label for="default-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
        <input name="name" type="text" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the name of the shoes...">
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
        <input name="price" type="number" id="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the price of the shoes...">
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">description</label>
        <textarea name="description" id="description" cols="45" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the content of the shoes..."><?= set_value('body') ?></textarea>
    </div>
    <div class="relative z-0 w-full mb-6 group">
        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
        <input name="quantity" type="number" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the quantity of the shoes...">
    </div>
    <div class="relative z-0 w-full mb-6 group flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/2 lg:mr-2">
            <label for="rating_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating rate</label>
            <input name="rating_rate" type="number" id="rating_rate" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the rating_rate of the shoes...">
        </div>
        <div class="w-full lg:w-1/2 lg:ml-2">
            <label for="rating_count" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating count</label>
            <input name="rating_count" type="number" id="rating_count" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write the rating_count of the shoes...">
        </div>
    </div>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload an image for the shoes</label>
        <input name="image" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file">
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">SVG, PNG, JPG.</p>
    </div>
    <button type="submit" name="submit" class=" my-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
<?= $this->endSection() ?>