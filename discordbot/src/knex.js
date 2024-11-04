import connect from 'knex';
import { config } from './config.js';

export const knex = connect({
    client: config.db.client,
    connection: config.db,
});

knex.raw('SELECT 1')
    .then(() => console.log('Database connection has been established'))
    .catch(error => {
        console.error('Unable to establish database connection: %s', error.message);
        process.exit(-1);
    });
