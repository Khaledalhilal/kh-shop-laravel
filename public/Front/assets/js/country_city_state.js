// Todo: Create a function that loads the country, state, city, zip

const countryStateInfo = {
    Lebanon: {
        Beirut: {
            "Los Angeles": ["90001", "90002", "90003", "90004"],
            "San Diego": ["92093", "92101"],
        },

        Tripoli: {
            ali: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Sidon: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Baalbek: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Tyre: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Nabatieh: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Aley: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Jounieh: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },

        Zahle: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },
        Zgharta_Ehden: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },
        Byblos: {
            Dallas: ["75201", "75202"],
            Austin: ["73301", "73344"],
        },
        Batroun: {
            Dallas: ["75201", ""],
            Austin: ["73301", "73344"],
        },
    },
};


// ! When the window loads it will first select all the necessary elements from the DOM using javascript querySelector
window.onload = function () {
    //todo: Get all input html elements from the DOM

    const countrySelection = document.querySelector("#Country"),
        stateSelection = document.querySelector("#State"),
        citySelection = document.querySelector("#City");
    // console.log(countrySelection, stateSelection, citySelection);


    // todo: Disable all  Selection by setting disabled to false
  stateSelection.disabled = true; // remove all options bar first
  citySelection.disabled = true; // remove all options bar first
    for (let country in countryStateInfo) {
    countrySelection.options[countrySelection.options.length] = new Option(
      country,
      country
    );
    }

     //Todo: Country Changed

  countrySelection.onchange = (e) => {
    stateSelection.disabled = false;
    // todo: Clear all options from State Selection
    stateSelection.length = 1; // remove all options bar first
    citySelection.length = 1; // remove all options bar first

    // if (e.target.selectedIndex < 1) return; // done

    // todo: Load states by looping over countryStateInfo
    for (let state in countryStateInfo[e.target.value]) {
      stateSelection.options[stateSelection.options.length] = new Option(
        state,
        state
      );
    }
    };

     //todo: State Changed
  stateSelection.onchange = (e) => {
    citySelection.disabled = false;
    citySelection.length = 1; // remove all options bar first
    for (let city in countryStateInfo[countrySelection.value][e.target.value]) {
      citySelection.options[citySelection.options.length] = new Option(
        city,
        city
      );
    }
    };
     //todo: State Changed
  stateSelection.onchange = (e) => {
    citySelection.disabled = false;
    citySelection.length = 1; // remove all options bar first
    for (let city in countryStateInfo[countrySelection.value][e.target.value]) {
      citySelection.options[citySelection.options.length] = new Option(
        city,
        city
      );
    }
  };
}
