export default {
    processing: state => state.processing,
    responseCode: state => state.responseCode,
    books: state => state.books,
    authors: state => state.authors,
    genres: state => state.genres,
    languages: state => state.languages,
    errors: state => state.errors,
    editingBook: state => state.editingBook,
    formVisibility: state => state.formVisibility,
};