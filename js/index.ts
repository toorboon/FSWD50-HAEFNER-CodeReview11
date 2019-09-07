//here goes the js for the index.html
//defining parent class Location and child class Restaurant and Event
class Locations {
	constructor(
		public loc_type: string,
		public name: string,
		public city: string,
		public zip: number,
		public address: string,
		public img_src: string,
		public visit_time?: Date
		){}
	render (){
		
		return `
				<div class="col-12 col-lg-3 col-sm-6 p-1">
					<div class="d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box">	
						<!--it might be a good idea to put a container with flex-row which is put to display none for sm displays d-sm-none-->
							<img class="d-sm-block rounded" src="${this.img_src}" alt="">
				        	<div class="d-flex flex-column align-content-space-between p-2">
				              <h4 class="m-auto">${this.name}</h4>
				              <hr class="m-auto">
				              <p class="m-auto"><span>${this.city}, </span><span>${this.zip}</span></p>
				              <p class="m-auto">${this.address}</p>
				              ${this.visited()}
				            </div>
	            	</div>
	            </div>
	            `
	}
	visited (){
		let options = {year: '2-digit', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit'}
		if (this.visit_time){
			return `
				<p class="m-auto">visited: ${new Intl.DateTimeFormat('de-DE', options).format(this.visit_time)}</p>
				`
		} else {
			return ''
		}
	}
	
}

class Restaurant extends Locations{
	public phone: number;
	public phone_type: string;
	public url: string;
	constructor(loc_type: string, name: string, city: string, zip: number, address: string, img_src: string, phone: number, phone_type: string, url: string){
		super(loc_type, name, city, zip, address, img_src);
		this.phone = phone;
		this.phone_type = phone_type;
		this.url = url;
	}
	render(){
		

		return `
				<div class="col-12 col-lg-3 col-sm-6 p-1">
					<div class="d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box">
						<img class="d-sm-block rounded" src="${this.img_src}" alt="">
			        	<div class="d-flex flex-column align-content-space-between p-2">
			              <h4 class="m-auto">${this.name}</h4>
			              <hr class="m-auto">
			              <p class="m-auto"><span>${this.city}, </span><span>${this.zip}</span></p>
			              <p class="m-auto"><span>${this.phone}</span><span> (${this.phone_type})</span></p>
			              <p class="m-auto">${this.url}</p>
			            </div>
		            </div>
	            </div>
	            `
	}
}

class Events extends Locations{
	public event_date: Date;
	public event_location: string;
	public ticket_price: string;
	constructor(loc_type: string, name: string, city: string, zip: number, address: string, img_src: string, event_date: Date, event_location: string, ticket_price: string){
		super(loc_type, name, city, zip, address, img_src);
		this.event_date = event_date;
		this.event_location = event_location;
		this.ticket_price = ticket_price;
	}
	render(){
		//this is necessary, to get my desired output format, though I'm unsure how many browser support that!
		let options = {year: 'numeric', month: '2-digit', day: 'numeric'}
		let options_time = {hour: '2-digit', minute: '2-digit', weekday: 'long'}
		return `
				<div class="col-12 col-lg-3 col-sm-6 p-1">
					<div class="d-flex flex-nowrap flex-sm-column align-items-center justify-content-center bg-white p-2 rounded content_box">
						<img class="d-sm-block rounded" src="${this.img_src}" alt="">
			        	<div class="d-flex flex-column align-content-space-between p-2">
			              <h4 class="m-auto">${this.name}</h4>
			              <hr class="m-auto">
			              <p class="m-auto"><span>${this.city}, </span><span>${this.zip}</span></p>
			              <p class="m-auto">${this.address}</p>
			              <p class="m-auto">${new Intl.DateTimeFormat('de-DE', options).format(this.event_date)}</p>
			              <p class="m-auto">${new Intl.DateTimeFormat('de-DE', options_time).format(this.event_date)}</p>
			              <p class="m-auto">${this.event_location}</p>
			              <p class="m-auto">${this.ticket_price}€</p>
			            </div>
		            </div>
	            </div>
	            `
	}
}

//Eventuell noch den Type in die Klassen integrieren, um später auch eine Zuordnung zu den Tabs machen zu können!!!
var location_map: any = []
location_map.push(new Locations("location", "Karlskirche", "Vienna", 1010, "Karlsplatz 1", "img/karlskirche.jpg", new Date(2016,11,9,14,30)));
location_map.push(new Locations("location", "Viennas Zoo", "Vienna", 1130, "Maxingstraße 13b", "img/vienna_zoo.jpg"));
location_map.push(new Locations("location", "Viennas Zoo", "Vienna", 1130, "Maxingstraße 13b", "img/vienna_zoo.jpg"));

location_map.push(new Restaurant("restaurant", "Lemon Leaf Thai", "Vienna", 1050, "Kettenbrückengasse 19", "img/lemon_leaf_restaurant.png", 4315812308, "Austrian", "www.lemonleaf.at"));
location_map.push(new Restaurant("restaurant", "Sixta", "Vienna", 1050, "Schönbrunner Straße 21", "img/sixta_restaurant.png", 4315852856, "Austrian", "www.sixta-restaurant.at"));
location_map.push(new Restaurant("restaurant", "Sixta", "Vienna", 1050, "Schönbrunner Straße 21", "img/sixta_restaurant.png", 4315852856, "Austrian", "www.sixta-restaurant.at"));

location_map.push(new Events("event", "Kris Kristo", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_kris_kristofferson.jpg", new Date(2018,10,15,20,0),"Wiener Stadthalle, Halle F", "58.50"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019,11,9,19,30), "Wiener Stadthalle, Halle D", "47.80"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019,11,9,19,30), "Wiener Stadthalle, Halle D", "47.80"));
location_map.push(new Events("event", "Lenny Kravitz", "Vienna", 1150, "Roland Rainer Platz 1", "img/event_lenny_kravitz.jpg", new Date(2019,11,9,19,30), "Wiener Stadthalle, Halle D", "47.80"));


console.log(location_map);

for (let item in location_map) {
	//deprecated, not needed anymore
	let {loc_type} = location_map[item];
	
	if (loc_type == "location") {
		$('#locations_injection').append(location_map[item].render());
	};
	if (loc_type == "restaurant") {
		$('#restaurants_injection').append(location_map[item].render());
	}
	if (loc_type == "event") {
		$('#events_injection').append(location_map[item].render());
	}	
}

