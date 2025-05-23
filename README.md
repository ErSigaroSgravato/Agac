# Agac (Awesome Game Achievement Collection)

Agac is a modern web application that helps gamers track their gaming achievements, playtime, and progress across different games. Built with Laravel and featuring a beautiful, Apple-inspired dark theme UI.

## Features

- 🎮 **Game Library Management**
  - Track your game collection
  - View detailed game information
  - Monitor playtime statistics
  - Browse and discover new games

- 🏆 **Achievement Tracking**
  - Track game achievements
  - View achievement progress
  - Compare with other players
  - Get achievement statistics

- 📊 **Statistics & Analytics**
  - Total playtime tracking
  - Playtime distribution by day
  - Most played games
  - Recent gaming activity
  - Achievement completion rates

- 🎯 **Missions & Challenges**
  - Daily and weekly missions
  - Achievement-based challenges
  - Progress tracking
  - Reward system

- 🏅 **Leaderboards**
  - Global rankings
  - Game-specific leaderboards
  - Achievement-based rankings
  - Playtime comparisons

## Requirements

- PHP 8.1 or higher
- MySQL 5.7 or higher
- Composer
- Node.js & NPM
- Steam API Key (for Steam integration)
- RAWG API Key (for game data)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/yourusername/agac.git
cd agac
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install NPM dependencies:
```bash
npm install
```

4. Create environment file:
```bash
cp .env.example .env
```

5. Generate application key:
```bash
php artisan key:generate
```

6. Configure your database in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agac
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

7. Run migrations:
```bash
php artisan migrate
```

8. Build assets:
```bash
npm run build
```

9. Start the development server:
```bash
php artisan serve
```

## API Keys Setup

### Steam API Key
1. Go to [Steam Web API](https://steamcommunity.com/dev/apikey)
2. Log in with your Steam account
3. Register for a new API key
4. Add the key to your `.env` file:
```env
STEAM_API_KEY=your_steam_api_key
```

### RAWG API Key
1. Go to [RAWG API](https://rawg.io/apidocs)
2. Create an account
3. Get your API key
4. Add the key to your `.env` file:
```env
RAWG_API_KEY=your_rawg_api_key
```

## Usage

### Game Management
- Add games to your library
- Track playtime automatically
- View detailed game information
- Monitor achievement progress

### Achievement Tracking
- View all achievements for each game
- Track completion status
- Compare with other players
- Get achievement statistics

### Statistics
- View total playtime
- Check recent gaming activity
- See playtime distribution
- Monitor achievement progress

### Missions
- Complete daily missions
- Track weekly challenges
- Earn rewards
- Compare progress with friends

### Leaderboards
- View global rankings
- Check game-specific leaderboards
- Compare achievement progress
- Track playtime rankings

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

- [Laravel](https://laravel.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Steam Web API](https://steamcommunity.com/dev)
- [RAWG API](https://rawg.io/apidocs)
- [Font Awesome](https://fontawesome.com)

## Support

If you encounter any issues or have questions, please:
1. Check the [documentation](docs/README.md)
2. Search [existing issues](https://github.com/yourusername/agac/issues)
3. Create a new issue if needed

## Roadmap

- [ ] Steam achievement sync
- [ ] Discord integration
- [ ] Mobile app
- [ ] Social features
- [ ] Game recommendations
- [ ] Custom missions
- [ ] Achievement guides
- [ ] Game reviews
- [ ] Community features
