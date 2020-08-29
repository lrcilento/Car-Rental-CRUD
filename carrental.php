<html>
    <head>
        <meta charset="utf-8" />
        <title>Car Rental CRUD API</title>
    </head>
    <body onload="createTypeSelect()">
        <style>
            h1{ 
                text-align: center;
            }
            button {
                margin:auto;
                display:block;
            }
            #main {
                background-color: lightgrey;
                border: 2px solid black;
                border-radius: 25px;
                padding: 20px;
                width:25%;
                margin: auto;
            }
            body {
                background-color: darkcyan;
            }
            input {
                width: 100%;
            }
            label {
                padding:5px;
            }
            select {
                float: right;
                width: 35%;
            }
            .select {
                padding: 10px;
                margin: auto;
                width: 60%;
            }
            #root {
                text-align: center;
                font-size:larger;
                overflow: auto;
            }
        </style>

        <script src="https://unpkg.com/react@16.8.6/umd/react.development.js"></script>
        <script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.development.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <div id="main">
            <h1>Car Rental CRUD API</h1>

            <div class="select">
                <label for="endpoint">Choose an endpoint:</label>
                <select id="endpoint" name="endpoint">
                    <option value="cars">Cars</option>
                    <option value="clients">Clients</option>
                    <option value="rents">Rents</option>
                </select>
            </div>
            <br>
            <div class="select">
                <label for="operation">Choose an operation:</label>
                <select id="operation" name="operation">
                    <option value="read">Get All</option>
                    <option value="single_read">Get One</option>
                    <option value="create">Create</option>
                    <option value="update">Update</option>
                    <option value="delete">Delete</option>
                </select>
            </div>
            <br>
            <div id="typeSelect" class="select"></div>

            <br>

            <button onclick="run()">Run!</button>
            <br>
        
            <div id="root"></div>
        </div>

        <script>

            document.getElementById("operation").addEventListener("change", createTypeSelect)
            document.getElementById("endpoint").addEventListener("change", createTypeSelect)

            function createTypeSelect() {
                document.getElementById("root").innerHTML = "";
                var operation = document.getElementById("operation").value
                var endpoint = document.getElementById("endpoint").value

                if (endpoint == "clients") {
                    pk = "CPF";
                    pkl = "cpf";
                }
                else if (endpoint == "cars") {
                    pk = "Plate";
                    pkl = "plate";
                }
                else {
                    pk = "ID";
                    pkl = "id";
                }

                if (operation == "single_read" || operation == "delete") {
                    var structure = React.createElement("label", {for: pkl}, pk+":",
                        React.createElement("input", {type: "text", id: pkl, name: pkl})
                    )
                }

                else if (operation == "create" || operation == "update") {
                    if (endpoint == "clients") {
                        var structure = React.createElement("div", null,
                                            React.createElement("label", {for: "cpf"}, pk+":",
                                                React.createElement("input", {type: "text", id: "cpf", name: "cpf"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "name"}, "Name:",
                                                React.createElement("input", {type: "text", id: "name", name: "name"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "address"}, "Address:",
                                                React.createElement("input", {type: "text", id: "address", name: "address"})
                                            )
                                        )
                    }
                    else if (endpoint == "cars"){
                        var structure = React.createElement("div", null,
                                            React.createElement("label", {for: "plate"}, pk+":",
                                                React.createElement("input", {type: "text", id: "plate", name: "plate"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "model"}, "Model:",
                                                React.createElement("input", {type: "text", id: "model", name: "model"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "year"}, "Year:",
                                                React.createElement("input", {type: "text", id: "year", name: "year"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "color"}, "Color:",
                                                React.createElement("input", {type: "text", id: "color", name: "color"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "dailyRate"}, "Daily Rate:",
                                                React.createElement("input", {type: "text", id: "dailyRate", name: "dailyRate"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "status"}, "Status (0/1):",
                                                React.createElement("input", {type: "text", id: "status", name: "status"})
                                            )
                                        )
                    }
                    else if (endpoint == "rents") {
                        var structure = React.createElement("div", null,
                                            React.createElement("label", {for: "id"}, pk+":",
                                                React.createElement("input", {type: "text", id: "id", name: "id"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "client_cpf"}, "Client CPF:",
                                                React.createElement("input", {type: "text", id: "client_cpf", name: "client_cpf"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "car_plate"}, "Car Plate:",
                                                React.createElement("input", {type: "text", id: "car_plate", name: "car_plate"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "startDate"}, "Start Date:",
                                                React.createElement("input", {type: "text", id: "startDate", name: "startDate"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "endDate"}, "End Date:",
                                                React.createElement("input", {type: "text", id: "endDate", name: "endDate"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "totalPrice"}, "Total Price:",
                                                React.createElement("input", {type: "text", id: "totalPrice", name: "totalPrice"})
                                            ),
                                            React.createElement("br", null, null),
                                            React.createElement("label", {for: "status"}, "Status (0/1):",
                                                React.createElement("input", {type: "text", id: "status", name: "status"})
                                            )
                                        )

                    }
                }

                ReactDOM.render(structure, document.getElementById('typeSelect'))
            }

            function run() {
                var operation = document.getElementById("operation").value;
                var endpoint = document.getElementById("endpoint").value;

                baseURL = "api/"+endpoint+"/"+operation+".php";
                var xhr = new XMLHttpRequest();

                if (operation == "read") {
                    xhr.open("GET", baseURL, true);
                    xhr.setRequestHeader("Content-Type", "application/json"); 
                    xhr.onreadystatechange = function () { 
                        if (xhr.readyState === 4 && xhr.status === 200) { 
                            document.getElementById("root").innerHTML = this.responseText; 
                        }
                    };
                    xhr.send();
                }

                else if (operation == "single_read") {
                    var pkval = document.getElementById(pkl).value;
                    baseURL = baseURL+"/?"+pkl+"="+pkval;
                    xhr.open("GET", baseURL, true);
                    xhr.setRequestHeader("Content-Type", "application/json"); 
                    xhr.onreadystatechange = function () { 
                        if (xhr.readyState === 4 && xhr.status === 200) { 
                            document.getElementById("root").innerHTML = this.responseText; 
                        }
                    };
                    xhr.send();
                }

                else if (operation == "delete") {
                    var pkval = document.getElementById(pkl).value;

                    xhr.open("DELETE", baseURL, true);
                    xhr.setRequestHeader("Content-Type", "application/json"); 

                    xhr.onreadystatechange = function () { 
                        if (xhr.readyState === 4 && xhr.status === 200) { 
                            document.getElementById("root").innerHTML = this.responseText; 
                        }
                    };
                    if (endpoint == "rents") {
                        var data = JSON.stringify({ "id" : pkval });
                    }
                    else if (endpoint == "clients") {
                        var data = JSON.stringify({ "cpf" : pkval });
                    }
                    else if (endpoint == "cars") {
                        var data = JSON.stringify({ "plate" : pkval });
                    }
                    xhr.send(data); 
                }

                else if (operation =="create" || operation =="update") {
                    var pkval = document.getElementById(pkl).value;

                    xhr.open("POST", baseURL, true);
                    xhr.setRequestHeader("Content-Type", "application/json"); 

                    xhr.onreadystatechange = function () { 
                        if (xhr.readyState === 4 && xhr.status === 200) { 
                            document.getElementById("root").innerHTML = this.responseText; 
                        }
                    };

                    if (endpoint == "rents") {
                        var client_cpf = document.getElementById("client_cpf").value;
                        var car_plate = document.getElementById("car_plate").value;
                        var startDate = document.getElementById("startDate").value;
                        var endDate = document.getElementById("endDate").value;
                        var totalPrice = document.getElementById("totalPrice").value;
                        var status = document.getElementById("status").value;

                        var data = JSON.stringify({ "id" : pkval, "client_cpf": client_cpf, "car_plate":car_plate, 
                                                    "startDate":startDate, "endDate":endDate, "totalPrice":totalPrice, "rentStatus":status });
                    }
                    else if (endpoint == "clients") {
                        var name = document.getElementById("name").value;
                        var address = document.getElementById("address").value;

                        var data = JSON.stringify({ "cpf" : pkval, "name":name, "address":address });
                    }
                    else if (endpoint == "cars") {
                        var model = document.getElementById("model").value;
                        var year = document.getElementById("year").value;
                        var color = document.getElementById("color").value;
                        var dailyRate = document.getElementById("dailyRate").value;
                        var status = document.getElementById("status").value;

                        var data = JSON.stringify({ "plate" : pkval, "model":model, "year":year, "color":color, "dailyRate":dailyRate, "rentStatus":status });
                    }
                    xhr.send(data); 
                }
            }

            function createJSON() {
                
            }

        </script>
    </body>
</html>
