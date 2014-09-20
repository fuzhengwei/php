package com.bjsxt.service;

import org.junit.Test;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

import com.bjsxt.model.User;
import com.bjsxt.service.UserService;

public class UserServiceTest {

	@Test
	public void testAdd() throws Exception {
		ApplicationContext ctx = new ClassPathXmlApplicationContext("beans.xml");
		UserService userService = (UserService)ctx.getBean("userService"); 
		
//		UserDAO userDAO = (UserDAO)ctx.getBean("userDAO");
//		userService.setUserDAO(userDAO);
		userService.add(new User());
	}

}
