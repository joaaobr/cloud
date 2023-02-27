import User from './model/User';

export default class Validator {
  validateUserData(name: string, email: string, password: string) {
    if (!name) return { message: 'name is required!' };
    if (!email) return { message: 'e-mail is required!' };
    if (!password) return { message: 'password is required!' };
  }

  async validateIfEmailAlreadyExists(email: string) {
    const user = await User.findOne({ email });

    if (user) return { message: 'this e-mail already exists!' };
  }

  async validateIfIdAlreadyExists(id: string) {
    const user = await User.findById(id);

    if (!user) return { message: 'this id is not already exists!' };
  }
}
