package com.bjsxt.registration.service;

import org.junit.Assert;
import org.junit.Test;

import com.bjsxt.registration.model.User;
import com.bjsxt.registration.service.impl.UserManagerImpl;

public class UserManagerTest {

	@Test
	public void testExists() throws Exception {
		UserManager um = new UserManagerImpl();
		User u = new User();
		u.setUsername("a");
		boolean exists = um.exists(u);
		Assert.assertEquals(true, exists);
	}

	@Test
	public void testAdd() throws Exception {
		UserManager um = new UserManagerImpl();
		User u = new User();
		u.setUsername("b");
		u.setPassword("b");
		boolean exists = um.exists(u);
		if(!exists) {
			um.add(u);
			u.setUsername("b");
			Assert.assertEquals(true, um.exists(u));
			
		} else {
			Assert.fail("not added");
		}
		
	}

}
