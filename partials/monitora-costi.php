<? include("../utils/middleware.php") ?>
<? include("./header.php") ?>
<? include("./navbar.php") ?>

<main x-data="monitoraCosti" class="mt-8 p-2">
	<h1 class="text-4xl text-center">Monitora costi</h1>
	<div class="min-h-80 flex items-center justify-center">
		<form class="border p-4 rounded-lg border-slate-300">
			<div class="flex flex-col gap-1">
				<label for="data_spesa" class="block mb-2 text-sm font-medium text-gray-900">Giorno spesa</label>
				<input x-model="data_spesa" type="date" name="data_spesa" class="outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-2 focus:border-blue-500 block w-full p-2.5" placeholder="data_spesa" />
			</div>
			<div class="flex flex-col gap-1 mt-4">
				<label for="importo" class="block mb-2 text-sm font-medium text-gray-900">Importo</label>
				<input x-model="importo" name="importo" type="number" class="outline-none bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-2 focus:border-blue-500 block w-full p-2.5" placeholder="importo €" required></input>
			</div>
			<div class="mt-4 flex justify-center"><button @click.prevent="addCost" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Aggiungi</button></div>
		</form>
	</div>
	<section class="md:w-2/3 mx-auto">
		<form class="max-w-sm ml-auto my-8">
			<label for="mesi" class="block mb-2 text-sm font-medium text-gray-900 ">Filtra i costi per mese</label>
			<select @change="filteredMonth" id="mesi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
				<option value="tutti" selected>Tutti</option>
				<template x-for="mese in mesi">
					<option x-text="mese"></option>
				</template>
			</select>
		</form>
	</section>
	<table x-show="costs.length != 0" class="table-fixed md:mx-auto md:w-2/3 w-screen text-sm text-left text-gray-500" x-transition>
		<thead class="text-xs text-gray-700 uppercase bg-gray-200">
			<tr>
				<th class="px-6 py-3">Data Lista</th>
				<th class="px-6 py-3">Importo</th>
				<th class="px-6 py-3">Azioni</th>
			</tr>
		</thead>
		<tbody>
			<template x-if="filteredCosts.length == 0">
				<tr>
					<td class="px-6 py-4"></td>
					<td class="px-6 py-4">Nessun elemento trovato</td>
					<td class="px-6 py-4"></td>
				</tr>
			</template>
			<template x-for="(element,index) in filteredCosts">
				<tr class="bg-white border-b">
					<td class="px-6 py-4" x-text="element.data_spesa"></td>
					<td class="px-6 py-4" x-text="element.importo+'€'"></td>
					<td class="py-4"><button @click="dropCost(element.id)" type="button" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
							<svg class="size-4 mr-1 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
								<path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd" />
							</svg>

							Elimina
						</button></td>
				</tr>
			</template>
		</tbody>
		<tfoot class="text-s font-bold text-gray-700 uppercase bg-gray-200">
			<tr>
				<td></td>
				<td class="px-6 py-4" x-text="calculateTotal()"></td>
				<td></td>
			</tr>
		</tfoot>
	</table>
</main>