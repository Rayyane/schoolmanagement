var jsUtlt = {	
clog : function(data){
console.log(data);
},	
//trigger event
fire : function( elem, type ) {
let event = new Event(type);
 	// dispatch, or fire the event
elem.dispatchEvent( event );
}
}