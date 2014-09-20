package com.bjsxt.service;
import org.junit.Test;
import org.springframework.context.ApplicationContext;
import org.springframework.context.support.ClassPathXmlApplicationContext;

import com.bjsxt.model.User;

//Dependency Injection
//Inverse of Control
public class UserServiceTest {

	@Test
	public void testAdd() throws Exception {
		ApplicationContext ctx = new ClassPathXmlApplicationContext("beans.xml");
		
		
		UserService service = (UserService)ctx.getBean("userService");
		
		
		User u = new User();
		u.setUsername("zhangsan");
		u.setPassword("zhangsan");
		service.add(u);
	}

}
