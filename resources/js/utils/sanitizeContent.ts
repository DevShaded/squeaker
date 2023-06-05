export const containsHtmlElements = (content: string | null) => {
    const regex = /(<([^>]+)>)/ig
    return regex.test(content)
}

export const sanitizeContent = (content?: string | null) => {
    if (containsHtmlElements(content)) {
        return content.replace(/(<([^>]+)>)/ig, '')
    } else {
        return content
    }
}
