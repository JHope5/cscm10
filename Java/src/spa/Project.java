package spa;

import java.util.ArrayList;
import java.util.Scanner;

/**
 * A project is offered by a Lecturer, once the algorithm runs,
 * a Student is assigned to the Project.
 * @author James Hope
 *
 */
public class Project {

	private int id;
	private int capacity;
	private String code;
	private ArrayList<Student> assignedStudents = new ArrayList<Student>();
	private Lecturer lecturer = null;
	private ArrayList<Student> studentsInPreferenceList = new ArrayList<Student>();

	/**
	 * Reading the project's information
	 * @param id Project's identifier
	 * @param s Scanner to read the input
	 */
	Project(int id, Scanner s) {
		this.id = id;
		capacity = s.nextInt();
		code = s.next();
	}
	
	/**
	 * @return The project's code
	 */
	public String getCode() {
		return code;
	}
	
	/**
	 * @return The lecturer who offers the project
	 */
	public Lecturer getLecturer() {
		return lecturer;
	}

	/**
	 * @return The project's ID
	 */
	public int getID() {
		return id;
	}
	
	/**
	 * Setting the lecturer lk who offers the project
	 * @param lk
	 */
	public void setLecturer(Lecturer lk) {
		this.lecturer = lk;
	}
	
	/**
	 * Adding the student to the lecturer's preference list
	 * @param si Student
	 */
	public void addStudentToList(Student si) {
		this.studentsInPreferenceList.add(si);
	}
	
	//public String toString() {
		//return "P"+id+" "+"code"+"\n";
	//}
	
	public boolean equals(Object obj) {
		if(this.getID() == ((Project)obj).getID()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Adding the student si to the list of those assigned to the project
	 * @param si
	 */
	public void assignStudent(Student si) {
		assignedStudents.add(si);
	}
	
	/**
	 * 
	 * @return True if the Project has exceeded its capacity, False if not
	 */
	public boolean isOverSubscribed() {
		if (this.assignedStudents.size() > capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * 
	 * @return True if the number of students assigned to the project matches the capacity, False if not
	 */
	public boolean isFull() {
		if (this.assignedStudents.size() == capacity) {
			return true;
		}
		else {
			return false;
		}
	}
	
	/**
	 * 
	 * @return The student that is lowest in the offering Lecturer's preference list
	 */
	public Student getWorstAssignedStudent() {
		int i = 0;
		for (Student si:assignedStudents) {
			if (studentsInPreferenceList.indexOf(si) >= i) {
				i = studentsInPreferenceList.indexOf(si);
			}
		}
		return studentsInPreferenceList.get(i);
	}
	
	/**
	 * 
	 * @param si
	 * @return A student from their index
	 */
	public int getIndexOfStudent(Student si) {
		return studentsInPreferenceList.indexOf(si);
	}
	
	/**
	 * 
	 * @return The total number of students in the offering lecturer's preference list
	 */
	public int getTotalStudentsInList() {
		return studentsInPreferenceList.size();
	}
	
	/**
	 * 
	 * @param index
	 * @return The student that has the provided index
	 */
	public Student getStudentByIndex(int index) {
		return studentsInPreferenceList.get(index);
	}
	
	/**
	 * If it is not possible that a stable matching includes a student assigned
	 * to this project, the provisional assignment is broken
	 * @param si A student
	 */
	public void breakProvisionalAssignment(Student si) {
		assignedStudents.remove(si);
	}
}
