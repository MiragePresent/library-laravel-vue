import axios from 'axios';
import {
    SET_BOOKS,
    SET_AUTHORS,
    SET_GENRES,
    SET_LANGUAGES,
    SET_EDITING_BOOK,
    SET_ERRORS,
    SET_FORM_VISIBILITY,
    CLEAR_ERRORS,
    CREATE_BOOK,
    UPDATE_BOOK,
    DELETE_BOOK, SET_RESPONSE_CODE,
} from "./types";

export default {
    fetchBooks({ commit }) {
        axios.get('/api/books/')
            .then(({ data }) => {
                commit(SET_BOOKS, data);
            })
            .catch((error) => {
                commit(SET_BOOKS, []);
                console.error('Books have not been loaded');
            });
    },
    fetchAuthors({ commit }){
        axios.get('/api/authors/')
            .then(({ data }) => {
                commit(SET_AUTHORS, data);
            })
            .catch((error) => {
                commit(SET_AUTHORS, []);
                console.error('Authors have not been loaded');
            });
    },
    fetchGenres({ commit }) {
        axios.get('/api/genres/')
            .then(({ data }) => {
                commit(SET_GENRES, data);
            })
            .catch((error) => {
                commit(SET_GENRES, []);
                console.error('Genres have not been loaded');
            });
    },
    fetchLanguages({ commit }) {
        axios.get('/api/languages/')
            .then(({ data }) => {
                commit(SET_LANGUAGES, data);
            })
            .catch((error) => {
                commit(SET_LANGUAGES, []);
                console.error('Languages have not been loaded');
            });
    },
    setEditing({ commit }, book) {
        commit(SET_EDITING_BOOK, book);
    },
    openForm({ commit }) {
        commit(SET_FORM_VISIBILITY, true);
    },
    closeForm({ commit }) {
        commit(SET_FORM_VISIBILITY, false);
    },
    create({ commit }, data) {
        commit(SET_RESPONSE_CODE, null);
        axios.post('/api/books/', data)
            .then(({ status, data }) => {
                commit(SET_RESPONSE_CODE, status);
                commit(CLEAR_ERRORS);
                commit(CREATE_BOOK, data);
            })
            .catch(({ response }) => {
                commit(SET_RESPONSE_CODE, response.status);
                if (response.status === 422) {
                    commit(SET_ERRORS, response.data.errors);
                }
                console.error('Book cannot be saved');
            });
    },
    update({ commit }, { book_id, data }) {
        commit(SET_RESPONSE_CODE, null);
        axios.patch(`/api/books/${book_id}/`, data)
            .then(({ status, data }) => {
                commit(SET_RESPONSE_CODE, status);
                commit(CLEAR_ERRORS);
                commit(UPDATE_BOOK, data);
            })
            .catch(({ response }) => {
                commit(SET_RESPONSE_CODE, response.status);
                if (response.status === 422) {
                    commit(SET_ERRORS, response.data.errors);
                }
                console.error('Book cannot be saved');
            });
    },
    destroy({ commit }, book_id) {
        axios.delete(`/api/books/${book_id}/`)
            .then(({ status }) => {
                commit(SET_RESPONSE_CODE, status);
                commit(DELETE_BOOK, book_id);
            })
            .catch(({ response }) => {
                commit(SET_RESPONSE_CODE, response.status);
                console.warn('Book has not been removed');
            })
    },
    clearErrors({ commit }) {
        commit(CLEAR_ERRORS);
    },
}