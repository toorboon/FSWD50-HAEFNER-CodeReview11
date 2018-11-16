var __extends = (this && this.__extends) || (function () {
    var extendStatics = function (d, b) {
        extendStatics = Object.setPrototypeOf ||
            ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
            function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
        return extendStatics(d, b);
    }
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
//here goes the js for the index.html
//defining parent class Location and child class Restaurant and Event
var Locations = /** @class */ (function () {
    function Locations(loc_type, name, city, zip, address, img_src, visit_time) {
        this.loc_type = loc_type;
        this.name = name;
        this.city = city;
        this.zip = zip;
        this.address = address;
        this.img_src = img_src;
        this.visit_time = visit_time;
    }
    Locations.prototype.render = function () {
        return "\n\t\t\t\t<div class=\"col-12 col-lg-3 col-sm-6 p-1\">\n\t\t\t\t\t<div class=\"d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box\">\t\n\t\t\t\t\t\t<!--it might be a good idea to put a container with flex-row which is put to display none for sm displays d-sm-none-->\n\t\t\t\t\t\t\t<img class=\"d-sm-block rounded\" src=\"" + this.img_src + "\" alt=\"\">\n\t\t\t\t        \t<div class=\"d-flex flex-column align-content-space-between p-2\">\n\t\t\t\t              <h4 class=\"m-auto\">" + this.name + "</h4>\n\t\t\t\t              <hr class=\"m-auto\">\n\t\t\t\t              <p class=\"m-auto\"><span>" + this.city + ", </span><span>" + this.zip + "</span></p>\n\t\t\t\t              <p class=\"m-auto\">" + this.address + "</p>\n\t\t\t\t              " + this.visited() + "\n\t\t\t\t            </div>\n\t            \t</div>\n\t            </div>\n\t            ";
    };
    Locations.prototype.visited = function () {
        var options = { year: '2-digit', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit' };
        if (this.visit_time) {
            return "\n\t\t\t\t<p class=\"m-auto\">visited: " + new Intl.DateTimeFormat('de-DE', options).format(this.visit_time) + "</p>\n\t\t\t\t";
        }
        else {
            return '';
        }
    };
    return Locations;
}());
var Restaurant = /** @class */ (function (_super) {
    __extends(Restaurant, _super);
    function Restaurant(loc_type, name, city, zip, address, img_src, phone, phone_type, url) {
        var _this = _super.call(this, loc_type, name, city, zip, address, img_src) || this;
        _this.phone = phone;
        _this.phone_type = phone_type;
        _this.url = url;
        return _this;
    }
    Restaurant.prototype.render = function () {
        return "\n\t\t\t\t<div class=\"col-12 col-lg-3 col-sm-6 p-1\">\n\t\t\t\t\t<div class=\"d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box\">\n\t\t\t\t\t\t<img class=\"d-sm-block rounded\" src=\"" + this.img_src + "\" alt=\"\">\n\t\t\t        \t<div class=\"d-flex flex-column align-content-space-between p-2\">\n\t\t\t              <h4 class=\"m-auto\">" + this.name + "</h4>\n\t\t\t              <hr class=\"m-auto\">\n\t\t\t              <p class=\"m-auto\"><span>" + this.city + ", </span><span>" + this.zip + "</span></p>\n\t\t\t              <p class=\"m-auto\"><span>" + this.phone + "</span><span> (" + this.phone_type + ")</span></p>\n\t\t\t              <p class=\"m-auto\">" + this.url + "</p>\n\t\t\t            </div>\n\t\t            </div>\n\t            </div>\n\t            ";
    };
    return Restaurant;
}(Locations));
var Events = /** @class */ (function (_super) {
    __extends(Events, _super);
    function Events(loc_type, name, city, zip, address, img_src, event_date, event_location, ticket_price) {
        var _this = _super.call(this, loc_type, name, city, zip, address, img_src) || this;
        _this.event_date = event_date;
        _this.event_location = event_location;
        _this.ticket_price = ticket_price;
        return _this;
    }
    Events.prototype.render = function () {
        //this is necessary, to get my desired output format, though I'm unsure how many browser support that!
        var options = { year: 'numeric', month: '2-digit', day: 'numeric' };
        var options_time = { hour: '2-digit', minute: '2-digit', weekday: 'long' };
        return "\n\t\t\t\t<div class=\"col-12 col-lg-3 col-sm-6 p-1\">\n\t\t\t\t\t<div class=\"d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box\">\n\t\t\t\t\t\t<img class=\"d-sm-block rounded\" src=\"" + this.img_src + "\" alt=\"\">\n\t\t\t        \t<div class=\"d-flex flex-column align-content-space-between p-2\">\n\t\t\t              <h4 class=\"m-auto\">" + this.name + "</h4>\n\t\t\t              <hr class=\"m-auto\">\n\t\t\t              <p class=\"m-auto\"><span>" + this.city + ", </span><span>" + this.zip + "</span></p>\n\t\t\t              <p class=\"m-auto\">" + this.address + "</p>\n\t\t\t              <p class=\"m-auto\">" + new Intl.DateTimeFormat('de-DE', options).format(this.event_date) + "</p>\n\t\t\t              <p class=\"m-auto\">" + new Intl.DateTimeFormat('de-DE', options_time).format(this.event_date) + "</p>\n\t\t\t              <p class=\"m-auto\">" + this.event_location + "</p>\n\t\t\t              <p class=\"m-auto\">" + this.ticket_price + "\u20AC</p>\n\t\t\t            </div>\n\t\t            </div>\n\t            </div>\n\t            ";
    };
    return Events;
}(Locations));
//Eventuell noch den Type in die Klassen integrieren, um später auch eine Zuordnung zu den Tabs machen zu können!!!
var location_map = [];
location_map.push(new Locations("location", "Karlskirche", "Vienna", 1010, "Karlsplatz 1", "img/karlskirche.jpg", new Date(2016, 11, 9, 14, 30)));
location_map.push(new Locations("location", "Viennas Zoo", "Vienna", 1130, "Maxingstraße 13b", "img/vienna_zoo.jpg"));
location_map.push(new Locations("location", "Viennas Zoo", "Vienna", 1130, "Maxingstraße 13b", "img/vienna_zoo.jpg"));
location_map.push(new Restaurant("restaurant", "Lemon Leaf Thai", "Vienna", 1050, "Kettenbrückengasse 19", "img/lemon_leaf_restaurant.png", 4315812308, "Austrian", "www.lemonleaf.at"));
location_map.push(new Restaurant("restaurant", "Sixta", "Vienna", 1050, "Schönbrunner Straße 21", "img/sixta_restaurant.png", 4315852856, "Austrian", "www.sixta-restaurant.at"));
location_map.push(new Restaurant("restaurant", "Sixta", "Vienna", 1050, "Schönbrunner Straße 21", "img/sixta_restaurant.png", 4315852856, "Austrian", "www.sixta-restaurant.at"));
location_map.push(new Events("event", "Kris Kristo", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_kris_kristofferson.jpg", new Date(2018, 10, 15, 20, 0), "Wiener Stadthalle, Halle F", "58.50"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019, 11, 9, 19, 30), "Wiener Stadthalle, Halle D", "47.80"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019, 11, 9, 19, 30), "Wiener Stadthalle, Halle D", "47.80"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019, 11, 9, 19, 30), "Wiener Stadthalle, Halle D", "47.80"));
console.log(location_map);
for (var item in location_map) {
    //deprecated, not needed anymore
    var loc_type = location_map[item].loc_type;
    if (loc_type == "location") {
        $('#locations_injection').append(location_map[item].render());
    }
    ;
    if (loc_type == "restaurant") {
        $('#restaurants_injection').append(location_map[item].render());
    }
    if (loc_type == "event") {
        $('#events_injection').append(location_map[item].render());
    }
}
