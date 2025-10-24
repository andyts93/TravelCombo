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

new TomSelect("#airport_from_id", airportOptions);
new TomSelect("#airport_to_id", airportOptions);
