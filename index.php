<? include("./utils/middleware.php") ?>
<? include("./partials/header.php") ?>
<? include("./partials/navbar.php") ?>
<main x-data="shoppingList">
	<div x-show="loading" class="fixed w-screen md:w-1/3 bottom-0 md:bottom-10 md:right-10 rounded-lg text-center p-4 bg-green-200 text-green-600" x-transition>dati inviati correttamente</div>
	<h1 class="text-center text-5xl mt-10">Lista della spesa</h1>
	<div class="min-h-80 flex items-center justify-center">
		<form class="border p-4 rounded-lg border-slate-300">
			<div class="flex flex-col gap-1">
				<label for="nome_prodotto" class="text-sm">Nome prodotto</label>
				<input x-model="name" name="nome_prodotto" class="outline-none border border-slate-300 focus:border-none focus:ring-2 focus:ring-blue-300 rounded p-2" placeholder="nome prodotto" />
			</div>
			<div class="flex flex-col gap-1 mt-4">
				<label for="quantità" class="text-sm">Quantità prodotto</label>
				<input x-model="quantita" name="quantita" type="number" class="outline-none border border-slate-300 focus:border-none focus:ring-2 focus:ring-blue-300 rounded p-2" placeholder="quantità"></input>
			</div>
			<div class="mt-4 flex justify-center"><button @click.prevent="addToList" class="p-2 rounded bg-blue-500 hover:scale-105 duration-200 text-white w-2/3">Aggiungi</button></div>
		</form>
	</div>
	<table x-show="list.length != 0" class="table-fixed border-collapse w-full md:w-2/3 md:mx-auto" x-transition>
		<tr class="bg-slate-200 p-2">
			<th>Nome prodotto</th>
			<th>Quantità</th>
			<th>Azioni</th>
		</tr>
		<tbody x-data x-sort>
			<template x-for="(element,index) in list" :key="element.name+index">
				<tr x-sort:item @click="checked=!checked" x-data="{ checked: false, modify: false }" :class="checked ? 'bg-green-200 p-2' : 'p-2' ">
					<td class="text-center p-2">
						<input type="text" class="outline-none border-none bg-transparent mx-auto text-center max-w-full"
							x-model="element.name" :readonly="!modify" />
					</td>
					<td class="text-center">
						<input @click.stop="" type="number" class="outline-none border-none bg-transparent mx-auto text-center max-w-full" x-model="element.quantita" :readonly="!modify">
					</td>
					<td class="text-center">
						<button class="p-1 bg-blue-500 text-white rounded" @click.stop.prevent="modify = !modify">
							<template x-if="!modify">
								<img class="size-4" src="./assets/images/pen.svg" alt="pen image">
							</template>
							<template x-if="modify">
								<img class="size-4" src="./assets/images/diskette-save.svg" alt="save disk image">
							</template>
						</button>
						<button class="p-1 rounded mx-2 bg-red-500 text-white" @click.stop.prevent="list.splice(index,1)">
							<img class="size-4" src="./assets/images/trash-bin.svg" alt="save disk image">
						</button>
					</td>
				</tr>
			</template>
		</tbody>
	</table>
	<div class="flex justify-center mt-8" x-show="list.length != 0">
		<button @click.prevent="saveList" class="p-2 rounded bg-blue bg-blue-500 hover:scale-105 duration-200 text-white">
			Salva Lista
		</button>
	</div>
</main>
<? include("./partials/footer.php") ?>