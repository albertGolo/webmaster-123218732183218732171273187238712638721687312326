import dotenv from 'dotenv';

const error = dotenv.config().error;

if (error) {
    console.error('Unable to load .env file: %s', error.message);
    process.exit(-1);
}

// Not bothering parsing any integers properly because it works anyway...
export const config = {
    token: process.env.TOKEN,
    serverId: process.env.SERVER_ID,
    roleIds: {
        verified: process.env.ROLE_ID_VERIFIED,
        membership: process.env.ROLE_ID_MEMBERSHIP,
    },
    db: {
        client: process.env.DB_CLIENT || 'mysql',
        host: process.env.DB_HOST || '127.0.0.1',
        port: process.env.DB_PORT || '3306',
        database: process.env.DB_DATABASE,
        user: process.env.DB_USER || 'root',
        password: process.env.DB_PASSWORD,
    },
};
