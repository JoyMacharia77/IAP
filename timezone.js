$(document) . ready(function()
{ //LAB 3
     //Returnsthe number of minutes ahead or behind greenwich meridian
     var offset = new Date() .getTimezoneOffset();
     //Return number of milliseconds since 1970/01/01:
     var timestamp = new Date().getTime();

     //We convert our time to: Universal Time Coordinated / Universal Coordinated Time*/
     var utc_timestamp = timestamp + (60000 * offset);

     $('#time_zone_offset').val(offset);
     $('#utc_timestamp').val(utc_timestamp);

});