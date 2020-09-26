const copy = (o) => {
	return JSON.parse(JSON.stringify(o));
}

const groupRowspan = (ao, key) => {
	let array_obj = copy(ao)
	let row = null
	let rowspan = []
	let count = 0

	for (let index = 0; index < array_obj.length; index++) {
		if(!row) {
			row = array_obj[index][key]
			count++
			rowspan[array_obj[index][key]] = count
		} else {
			if (array_obj[index][key] == row) {
				count++
				rowspan[array_obj[index][key]] = count
			} else {
				row = array_obj[index][key]
				count++
				rowspan[array_obj[index][key]] = count
				count = 1
			}
		}
	}

	row = null
	for (let index = 0; index < array_obj.length; index++) {
		if(array_obj[index][key] != row) {
			array_obj[index]['rowspan'] = rowspan[array_obj[index][key]]
			row = array_obj[index][key]
		} else {
			array_obj[index]['rowspan'] = null
		}
	}
	
	return array_obj

}

const convertArrayToObject = (array) => {
	let newObj = Object.assign({}, ...(array.map(item => ({ [item.key]: item.value }))))
	return newObj
};

const orderByProperty = (obj) => {
	let unordered = copy(obj)

	const ordered = {};
	Object.keys(unordered).sort().forEach(function(key) {
		ordered[key] = unordered[key];
	});

	return ordered
}

const convertQty = (qty, od, wt) => {
	let qty_mt = 0.02466 * (parseFloat(od) - parseFloat(wt)) * parseFloat(wt) / 1000;
	return (qty_mt * parseFloat(qty)).toFixed(2);
}
export {
	copy,
	groupRowspan,
	orderByProperty,
	convertQty,
	convertArrayToObject
}