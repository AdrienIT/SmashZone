let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"];

let monthAndYear = document.getElementById("monthAndYear");
// showCalendar(currentMonth, currentYear);

function toggleFilters() {
    div = document.getElementsByClassName("filter")[1]
    if (div.classList.contains("hide")) {
        div.classList.remove("hide")
    } else {
        div.classList.add("hide")
    }
}

function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear, liste_tournois);
}

function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear, liste_tournois);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear, liste_tournois);
}

function showCalendar(month, year) {
    console.log(liste_tournois);
    let firstDay = (new Date(year, month)).getDay() - 1;
    let daysInMonth = 32 - new Date(year, month, 32).getDate();

    let tbl = document.getElementById("calendar-body"); // body of the calendar

    // clearing all previous cells
    tbl.innerHTML = "";

    // filing data about month and in the page via DOM.
    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    // creating all cells
    let date = 1;
    let color_index = 1
    for (let i = 0; i < 6; i++) {
        // creates a table row
        let row = document.createElement("tr");
        //creating individual cells, filing them up with data.
        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("td");

                for (k = 0; k < liste_tournois.length; k++) {
                    normal_month = parseInt(month) + 1
                    normal_date = parseInt(date) + 1
                    full_date = new Date(year + "-" + normal_month + "-" + normal_date)
                    debut = new Date(liste_tournois[k]["date_debut"]);
                    fin = new Date(liste_tournois[k]["date_fin"]);
                    fin.setDate(fin.getDate() + 1)
                    if (full_date >= debut && full_date <= fin) {
                        div = document.createElement('div')
                        if (typeof liste_tournois[k]["order"] === 'undefined') {
                            for (var l = 1; l <= 100; l++) {
                                if (cell.getElementsByClassName("el-" + l.toString()).length === 0) {
                                    liste_tournois[k]["order"] = "el-" + l.toString()
                                    break;
                                }
                            }
                        }
                        if (typeof liste_tournois[k]["color"] === 'undefined') {
                            liste_tournois[k]["color"] = color_index;
                            color_index += 1;
                            if (color_index > 10) {
                                color_index = 1
                            }
                        }
                        if (date === debut.getDate() && year === debut.getFullYear() && month === debut.getMonth()) {
                            div.classList.add("start");
                            let cellText = document.createTextNode(liste_tournois[k]["nom_club"]);
                            div.appendChild(cellText);
                        } else if (full_date.getDate() === fin.getDate() && full_date.getFullYear() === fin.getFullYear() && full_date.getMonth() === fin.getMonth()) {
                            div.classList.add("end");
                        }
                        div.classList.add("line")
                        div.classList.add("color-" + liste_tournois[k]["color"].toString());
                        div.classList.add(liste_tournois[k]["order"]);
                        link = document.createElement("a")
                        link.classList.add("link")
                        link.href = "view_tournoi.php?id=" + liste_tournois[k]["tournoi_id"].toString()
                        divframe = document.createElement("div")
                        frame = document.createElement("iframe")
                        frame.src = "view_tournoi.php?id=" + liste_tournois[k]["tournoi_id"].toString()
                        divframe.classList.add("preview")
                        divframe.appendChild(frame)
                        link.appendChild(div)
                        cell.appendChild(link)
                        cell.appendChild(divframe)


                    }
                }
                let cellText = document.createTextNode(date);
                cell.className = "cell"
                if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                    cell.classList.add("bg-info");
                } // color today's date
                cell.appendChild(cellText);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row); // appending each row into calendar body.
    }
}