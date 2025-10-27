import TomSelect from "tom-select";

const airportOptions = {
    valueField: 'id',
    labelField: 'name',
    searchField: ['name', 'municipality'],
    load: function(query, callback) {
        fetch(`/api/airports?q=${query}`)
            .then(response => response.json())
            .then(json => {
                callback(json)
            })
            .catch(() => callback());
    },
    render: {
        option: function(data, escape) {
            return '<div><p>' + escape(data.name) + '</p><p class="ts-opt-desc">' + escape(data.municipality) + '</p></div>';
        },
    }
}

new TomSelect("#airport_from_id", {
    ...airportOptions,
    onChange(value) {
        returnTo.on('load', function () {
            returnTo.setValue(value);
            returnTo.on('load', () => {});
        });
        returnTo.load(value);
    }
});
new TomSelect("#airport_to_id", {
    ...airportOptions,
    onChange(value) {
        returnFrom.on('load', function () {
            returnFrom.setValue(value);
            returnFrom.on('load', () => {});
        });
        returnFrom.load(value);
    }
});
const returnFrom = new TomSelect("#airport_from_id_return", airportOptions);
const returnTo = new TomSelect("#airport_to_id_return", airportOptions);
