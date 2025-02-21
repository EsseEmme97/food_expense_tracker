<? include("../utils/db-connection.php") ?>
<? 
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		$email= $_POST["email"];
		$password=$_POST["password"];

		$query="SELECT * FROM users WHERE email=:email";
		$statement=$connection->prepare($query);
		$statement->bindParam(":email",$email);

		try{
			$statement->execute();
		}catch (PDOException $e){
			echo "qualcosa è andato storto" . $e->getMessage();
		}

		$user=$statement->fetch(PDO::FETCH_ASSOC);
		if($user && password_verify($password, $user["password"])){
			session_start();
			$_SESSION["user_id"]= $user["id"];
			header("Location: /");
		}
	}	
?>
<? include("../partials/header.php") ?>
<main class="min-h-screen flex items-center justify-center">
	<div class="flex flex-col items-center">
		<img src="../assets/images/cart-large.svg" class="rounded-full size-32 mb-4" />
		<form class="border p-4 rounded-lg border-slate-300" action="./login.php" method="POST">
			<div class="flex flex-col gap-1">
				<label for="email" class="text-sm">Email</label>
				<input name="email" class="outline-none border border-slate-300 focus:border-none focus:ring-2 focus:ring-blue-500 rounded p-2" placeholder="email" />
			</div>
			<div class="flex flex-col gap-1 mt-4">
				<label class="text-sm" for="password">Password</label>
				<input name="password" type="password" class="outline-none border border-slate-300 focus:border-none focus:ring-2 focus:ring-blue-500 rounded p-2" placeholder="password"></input>
			</div>
			<div class="mt-4 flex justify-center"><button class="p-2 rounded bg-blue-500 w-2/3 text-white">Invia</button></div>
		</form>
	</div>
</main>
<? include("../partials/footer.php") ?>