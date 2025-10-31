import TomSelect from "tom-select";

const airportOptions = {
    valueField: 'id',
    labelField: 'short_name',
    plugins: ['change_listener'],
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

const preset = (ts, value) => {
    ts.on('load', function() {
        ts.setValue(value);
        ts.on('load', () => {});
    });
    ts.load(value);
}

const outboundFrom = new TomSelect("#airport_from_id", {
    ...airportOptions,
    onChange(value) {
        preset(returnTo, value);
    }
});
const outboundTo = new TomSelect("#airport_to_id", {
    ...airportOptions,
    onChange(value) {
        preset(returnFrom, value);
    }
});
const returnFrom = new TomSelect("#airport_from_id_return", airportOptions);
const returnTo = new TomSelect("#airport_to_id_return", airportOptions);

document.addEventListener('set', evt => {
    const ts = [outboundFrom, outboundTo, returnFrom, returnTo].find(el => el.input.id === evt.target.id);
    if (ts) {
        preset(ts, evt.detail);
    }
})

