import { mapGetters } from 'vuex';
class Book {

    constructor() {
        this.title = '';
        this.author_id = '';
        this.genre_id = '';
        this.isbn = '';
        this.lang = '';
        this.collection = { ...mapGetters('book', ['books']) };
    }

    find(book_id) {

        let found = this.collection.books.findIndex(book => book.id === book_id);

        if (!found) {
            console.warning('Book is not found');
        } else {
            this.title = found.title;
            this.author_id = found.author_id;
            this.genre_id = found.genre_id;
            this.isbn = found.isbn;
            this.lang = found.lang;
        }
    }

    clear() {
        this.title = '';
        this.author_id = '';
        this.genre_id = '';
        this.isbn = '';
        this.lang = '';
    }
}

export default Book;