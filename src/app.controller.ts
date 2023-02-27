import { Controller, Post, Body, Param } from '@nestjs/common';
import { AppService } from './app.service';
import Validator from './app.validator';
import UserController from './app.user.controller';

@Controller()
export class AppController {
  constructor(
    private readonly appService: AppService,
    private readonly validator: Validator,
    private readonly userController: UserController,
  ) {}

  @Post('/create')
  create(@Body() body: any) {
    return this.userController.create(this.validator, body);
  }

  @Post('/delete/:id')
  delete(@Param('id') id: any) {
    return this.userController.delete(id);
  }

  @Post('/')
  async users() {
    return this.userController.getUsers();
  }
}
