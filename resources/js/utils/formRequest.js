const formRequest = async (formdata, url, method = 'post', callback = null) => {
    const request = {
        method,
        body: formdata,
    }
    let resultado = {}

    await fetch(url,request).then(resposta => {
        resultado.ok = resposta.ok
        return resposta.json()
    }).then(corpo => resultado.body = corpo).catch(reason => resultado.body = reason)

    if (callback) return callback(resultado.ok,resultado.body)
}

export default formRequest

