<? include("../utils/middleware.php") ?>
<? include("./header.php") ?>
<? include("../utils/db-connection.php") ?>
<? include("./navbar.php") ?>
<? 
	$query="SELECT * FROM lists ";
	$statement= $connection->prepare($query);

	try{
		$statement->execute();
	} catch (PDOException $e){
		echo "errore: ". $e->getMessage();
	}

	$lists= $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="p-2">
	<h1 class="text-4xl text-center">Elenco liste</h1>
	<? if (count($lists)!=0): ?>
	<? foreach($lists as $list): ?>
		<a class="p-2 rounded text-white bg-black mx-2 mt-4 inline-block" href="./lista.php?numero=<?= $list["id"] ?>"><?= $list["data_creazione"] ?></a>
	<? endforeach ?>
	<? else: ?>
		<p class="text-center mt-4 lg:text-left">Nessuna lista trovata</p>
	<? endif ?>	
</main>

<? include("./footer.php") ?>