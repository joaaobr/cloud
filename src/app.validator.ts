import User from './model/User';

export default class Validator {
  validateUserData(name: string, email: string, password: string) {
    if (!name) return { message: 'name is required!' };
    if (!email) return { message: 'e-mail is required!' };
    if (!password) return { message: 'password is required!' };

    return null;
  }

  async validateIfEmailAlreadyExists(email: string) {
    const user = await User.findOne({ email });

    if (user) return { message: 'this e-mail already exists!' };

    return null;
  }
}
