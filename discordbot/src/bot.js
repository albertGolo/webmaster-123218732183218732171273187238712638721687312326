import { Client, GatewayIntentBits, Partials, Events, ChannelType } from 'discord.js';
import { knex } from './knex.js';
import { config } from './config.js';

const client = new Client({
    intents: [
        GatewayIntentBits.Guilds,
        GatewayIntentBits.GuildMembers,
        GatewayIntentBits.MessageContent,
        GatewayIntentBits.DirectMessages,
    ],
    partials: [
        Partials.Channel,
        Partials.Message,
    ],
});

client.on(Events.MessageCreate, async (message) => {
    if (message.channel.type !== ChannelType.DM || message.author.id === client.user.id) {
        return;
    }

    const user = await knex('users')
        .where('discord_code', message.content)
        .select('id', 'username', 'membership_until AS membership')
        .first();

    if (!user) {
        await message.reply('Incorrect verification code.');
        return;
    }

    try {
        await knex('users')
            .where('id', user.id)
            .update({
                'discord_id': message.author.id,
                'discord_code': null,
            });

        const guild = client.guilds.cache.get(config.serverId);
        await guild.members.fetch(message.author.id);

        const member = guild.members.cache.get(message.author.id);
        await member.roles.add(config.roleIds.verified);
        await member.setNickname(user.username);

        if (user.membership) {
            await member.roles.add(config.roleIds.membership);
        } else {
            await member.roles.remove(config.roleIds.membership);
        }

        await message.reply(`You have successfully verified as ${user.username}.`);
    } catch (error) {
        console.error('Unable to verify user %s (%d): %s', user.username, message.author.id, error.message);

        await message.reply('Something went wrong when trying to verify you. Contact a staff member immediately.');
    }
});

client.login(config.token)
    .then(() => console.log('Bot logged in as %s#%s', client.user.username, client.user.discriminator))
    .catch(error => {
        console.error('Unable to connect to Discord: %s', error.message);
        process.exit(-1);
    });