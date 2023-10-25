const required = (value, args, { field }) => {
    
    if (!value) {
        if(field == 'phone'){
            var field = 'telefone'
        }else if(field == 'message'){
            var field = 'mensagem'
        }
        return `O campo ${field} é obrigatório.`
    }

    return true
}


const min = (value, [limit], { field }) => {
    if (!value || !value.length) {
        return true
    }

    if (value.length < limit) {
        if(field == 'phone'){
            var field = 'telefone'
        }else if(field == 'message'){
            var field = 'mensagem'
        }
        return `O campo ${field} deve ter no mínimo ${limit} caracteres.`
    }

    return true
}

const max = (value, [limit], { field }) => {
    if (!value || !value.length) {
        return true
    }

    if (value.length > limit) {
        if(field == 'phone'){
            var field = 'telefone'
        }else if(field == 'message'){
            var field = 'mensagem'
        }
        return `O campo ${field} deve ter no máximo ${limit} caracteres.`
    }

    return true
}

export { required, min, max }
