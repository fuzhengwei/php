package com.bjsxt.registration.util;

import org.hibernate.SessionFactory;
import org.hibernate.cfg.AnnotationConfiguration;

public class HibernateUtil {
	private static SessionFactory sf;
	static {
		sf = new AnnotationConfiguration().configure().buildSessionFactory();
	}
	
	public static SessionFactory getSessionFactory() {
		return sf;
	}
}
