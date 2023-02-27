import { Module } from '@nestjs/common';
import { AppController } from './app.controller';
import { AppService } from './app.service';
import Validator from './app.validator';
import UserController from './app.user.controller';

@Module({
  imports: [],
  controllers: [AppController],
  providers: [AppService, Validator, UserController],
})
export class AppModule {}
