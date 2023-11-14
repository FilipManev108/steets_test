export default function sendRequest(url, payload = {}){
    return $.ajax({url: url, type: 'POST', data: payload})
}