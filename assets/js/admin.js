import ProvincesUS from '../provinces-us.js';
import ProvincesCAN from '../provinces-can.js';

const { province: oldProvince } = itreAdmin;

const addOptions = data => {
    let options = [];
    let option = document.createElement('option');
    option.setAttribute('value', '');
    option.setAttribute('data-province', '');
    option.textContent = 'Province';
    options = [...options, option];

    for (const province in data) {
        const newOption = document.createElement('option');
        newOption.setAttribute('value', province);
        newOption.setAttribute('data-province',data[province]);
        newOption.textContent = data[province];
        if (province === oldProvince) {
            newOption.setAttribute('selected', 'selected');
        } else {
            newOption.removeAttribute('selected');
        }
        options = [...options, newOption];
    }

    return options;
}

class updateProvinces {

    constructor(countryVal = null, province) {
        this.update.call(province, countryVal);
    }

    update(country) {
        switch (country) {
            case 'CA':
                this.removeAttribute('disabled');
                this.innerHTML = '';
                addOptions(ProvincesCAN).forEach(option => this.append(option));
                break;
            case 'US':
                this.removeAttribute('disabled');
                this.innerHTML = '';
                addOptions(ProvincesUS).forEach(option => this.append(option));
                break;
            default:
                this.setAttribute('disabled', true);
                this.innerHTML = '<option value="" data-country="">Province</option>';
        }
    }
}


const provinces = () => {
    const address = document.querySelector('.address');
    
    if (!address) {
        return;
    }

    let newProvinces;

    const countryDropdown = address.querySelector('select#country');
    const provinceDropdown = address.querySelector('#province');
    newProvinces = new updateProvinces(countryDropdown.value, provinceDropdown);
    

    countryDropdown.addEventListener('change', function () {
        newProvinces = new updateProvinces(this.value, provinceDropdown);
    });
}
provinces();