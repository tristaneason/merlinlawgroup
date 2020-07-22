// Latest Tweet

require('./vendor-twitter-post-fetcher.js');

// Get latest tweet & write to a HTML el
var configProfile = {
  "profile": {"screenName": 'merlinlawgroup'},
  "domId": 'latest-tweet',
  "maxTweets": 1,
  "enableLinks": true,
  "showUser": false,
  "showTime": false,
  "showImages": false,
  "lang": 'en'
};
twitterFetcher.fetch(configProfile);


function handleTweets(tweets) {
    var x = tweets.length;
    var n = 0;
    var element = document.getElementById('latest-tweet');
    var html = '<ul>';
    while(n < x) {
      html += '<li>' + tweets[n] + '</li>';
      n++;
    }
    html += '</ul>';
    element.innerHTML = html;
}
