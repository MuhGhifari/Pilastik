<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Penilaian Sampah</title>
	<link rel="stylesheet" href="/css/hmpage_collect.css">
</head>

<body>
	<div class="content flex flex-col w-full gap-4 py-4 px-4 flex-1">
		<div class="items-center justify-center">
			<form method="GET" action="{{ route('test.this') }}">
				<div class="flex gap-2 items-center">
					<label for="filter" class="font-semibold">Filter:</label>
					<input type="text" id="id" name="id" class="border rounded px-2 py-1" placeholder="ID">
					<label for="filter" class="font-semibold">Filter:</label>
					<input type="text" id="bin_type" name="bin_type" class="border rounded px-2 py-1" placeholder="Tipe">
					<button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded">Terapkan</button>
				</div>
			</form>
		</div>
	</div>
</body>

</html>