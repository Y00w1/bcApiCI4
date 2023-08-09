<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<?= $this->include('partials/navb') ?>
<div class="mx-8">
  <div class="mx-auto max-w-2xl px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <?php if (! empty($shoes) && is_array($shoes)): ?>
        <h2 class="text-xl text-zinc-100 flex justify-center">Products</h2>
        <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
        <?php foreach ($shoes as $shoe): ?>
            <a href="/shoe/<?= esc($shoe['id'],'url')?>" class="group">
                <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">
                <img src="<?= esc($shoe['image'],'url')?>" alt="Shoe" class="h-full w-full object-cover object-center group-hover:opacity-75">
                </div>
                <p class="mt-1 text-lg font-medium text-gray-400"><?= esc($shoe['name'])?></p>
                <p class="mt-1 text-lg font-medium text-gray-400">Price: $<?= esc($shoe['price'])?></p>
                <h3 class="mt-4 text-sm text-gray-400">Quantity: <?= esc($shoe['quantity'])?>  | Avg rating: <?= esc($shoe['rating_rate'])?></h3>
            </a>
        <?php endforeach ?>
    </div>
    <?php else: ?>
        <div class="w-full flex items-center p-4 text-sm text-gray-800 border border-gray-300 rounded-lg bg-gray-50 dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">No shoes</span> Couldn't find any shoes for you
        </div>
    </div>
    <?php endif ?>
  </div>
</div>
<?= $this->endSection() ?>