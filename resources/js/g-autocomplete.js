window.addEventListener('load', async () => {
    await google.maps.importLibrary("places");

    const input = Array.from(document.getElementsByClassName('g-autocomplete'));
    if (input.length > 0) {
        input.forEach(i => {
            const form = i.closest('form');

            const placeAutocomplete = new google.maps.places.PlaceAutocompleteElement();
            i.appendChild(placeAutocomplete);

            placeAutocomplete.addEventListener('gmp-select', async ({ placePrediction }) => {
                const place = placePrediction.toPlace();
                await place.fetchFields({ fields: ['displayName', 'location', 'postalAddress'] });
                console.log(place.location, place.postalAddress);

                if (place.postalAddress) {
                    form.elements.name.value = place.displayName;
                    form.elements.addressLine.value = place.postalAddress.addressLines;
                    form.elements.city.value = place.postalAddress.locality;
                    form.elements.administrative_area.value = place.postalAddress.administrativeArea;
                    form.elements.postal_code.value = place.postalAddress.postalCode;
                    form.elements.region_code.value = place.postalAddress.regionCode;
                }
                if (place.location) {
                    form.elements.latitude.value = place.location.lat();
                    form.elements.longitude.value = place.location.lng();
                }
            });
        });
    }
})
