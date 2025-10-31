import './bootstrap';

import Alpine from 'alpinejs';
import dayjs from "dayjs";

window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data('flightForm', () => {
        return {
            type: 'round-trip',

            extract() {
                navigator.clipboard.readText().then(text => {
                    try {
                        const json = JSON.parse(text);
                        fetch('/api/flight/import', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(json),
                        }).then(response => response.json())
                            .then(json => {
                                const form = document.querySelector('#flight-form');

                                if(json.legs.length > 0) {
                                    let evt = new CustomEvent('set', {bubbles: true, detail: json.legs[0].airportFrom.id});
                                    form.querySelector('#airport_from_id').dispatchEvent(evt);
                                    evt = new CustomEvent('set', {bubbles: true, detail: json.legs[0].airportTo.id});
                                    form.querySelector('#airport_to_id').dispatchEvent(evt);

                                    form.querySelector('#date_from').value = json.legs[0].dateFrom;
                                    form.querySelector('#date_to').value = json.legs[0].dateTo;

                                    if (json.legs.length > 1) {
                                        let evt = new CustomEvent('set', {
                                            bubbles: true,
                                            detail: json.legs[1].airportFrom.id
                                        });
                                        form.querySelector('#airport_from_id_return').dispatchEvent(evt);
                                        evt = new CustomEvent('set', {bubbles: true, detail: json.legs[1].airportTo.id});
                                        form.querySelector('#airport_to_id_return').dispatchEvent(evt);

                                        form.querySelector('#date_from_return').value = json.legs[1].dateFrom;
                                        form.querySelector('#date_to_return').value = json.legs[1].dateTo;
                                    }
                                }
                                if (json.prices.length > 0) {
                                    form.querySelector('#price').value = json.prices[0].totalPrice;
                                }
                            })
                    } catch (e) {
                        console.error('JSON not valid');
                    }
                })
            }
        }
    })
});

Alpine.start();
