import {
    SET_BOOKS,
    SET_AUTHORS,
    SET_GENRES,
    SET_LANGUAGES,
    SET_EDITING_BOOK,
    SET_FORM_VISIBILITY,
    SET_ERRORS,
    CLEAR_ERRORS,
    CREATE_BOOK,
    UPDATE_BOOK,
    DELETE_BOOK, SET_RESPONSE_CODE,
} from './types';

export default {
    [SET_BOOKS](state, books) {
        state.books = books;
    },
    [SET_AUTHORS](state, authors) {
        state.authors = authors;
    },
    [SET_GENRES](state, genres) {
        state.genres = genres;
    },
    [SET_LANGUAGES](state, languages) {
        state.languages = languages;
    },
    [SET_EDITING_BOOK](state, book) {
        Object.assign(state.editingBook, book);
    },
    [SET_ERRORS](state, errors) {
        Object.keys(errors).forEach(function(key, index) {
            errors[key] = errors[key][0];
        });
        state.errors = errors;
    },
    [SET_RESPONSE_CODE](state, code) {
        state.responseCode = code;
    },
    [SET_FORM_VISIBILITY](state, visibility) {
        state.formVisibility = visibility;
    },
    [CLEAR_ERRORS](state) {
        Object.assign(state.errors, {
            title: '',
            author_id: '',
            genre_id: '',
            isbn: '',
            lang: '',
        });
    },
    [CREATE_BOOK](state, book) {
        state.books.push(book);
    },
    [UPDATE_BOOK](state, data) {
        Object.assign(state.books[state.books.findIndex(b => b.id === data.id)], data);
    },
    [DELETE_BOOK](state, book_id) {
        Vue.set(state, 'books', state.books.filter(b => b.id !== book_id));
    }
}