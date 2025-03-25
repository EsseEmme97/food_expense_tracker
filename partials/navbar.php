<?php 
    $current_path= basename($_SERVER["PHP_SELF"]);
    $root= $current_path == "index.php" ? "./partials/" : "./";
?>
<nav class="flex justify-between items-center px-2 pt-6">
    <a href="/"><img class="size-8 md:size-16" src="../assets/images/logo.svg"/></a>
    <div>
    <ul class="font-medium flex rounded-lg  md:space-x-8 ">
        <li>
          <a href="<?= $root?>monitora-costi.php" class=" relative after:absolute after:text-black after:p-1 after:bg-orange-500 after:content-['new'] after:animate-ping after:rounded after:text-xs after:-top-4 after:-right-4 py-2 px-3 rounded-sm <?= $current_path === "monitora-costi.php" ? "text-blue-700" : "text-gray-900" ?>">Monitora costi</a>
        </li>
        <li>
          <a href="<?= $root ?>liste.php" class="py-2 px-3 rounded-sm <?= $current_path === "liste.php" || $current_path == "lista.php" ? "text-blue-700" : "text-gray-900" ?> ">Vedi liste</a>
        </li>
    </ul>
    </div>
</nav>

