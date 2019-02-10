// functional_style.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include <functional>
#include <iostream>
#include <memory>
#include <string>

using namespace std;

using FlyBehavior = function<void(void)>;
using QuackBehavior = function<void(void)>;
using DanceBehavior = function<void(void)>;

void ValseBehavior()
{
	cout << "I'm dance valse!" << endl;
}

void MinuetBehavior()
{
	cout << "I'm dance minuet!" << endl;
}

void DanceNoBehavior()
{
}

void FlyWithWings()
{
	cout << "I'm flying with wings!!" << endl;
}

void FlyNoWay()
{
}

void DoubleQuackBehavior()
{
	cout << "Quack Quack!!!" << endl;
}

void SqueakBehavior()
{
	cout << "Squeek!!!" << endl;
}

void MuteQuackBehavior()
{
}

class Duck
{
public:
	void SetFlyBehavior(const FlyBehavior& behavior)
	{
		m_flyBehavior = behavior;
	}

	void SetQuackBehavior(const QuackBehavior& behavior)
	{
		m_quackBehavior = behavior;
	}

	void SetDanceBehavior(const DanceBehavior& behavior)
	{
		m_danceBehavior = behavior;
	}

	void Quack() const
	{
		if (m_quackBehavior)
		{
			m_quackBehavior();
		}
	}

	void Dance() const
	{
		if (m_danceBehavior)
		{
			m_danceBehavior();
		}
	}

	void Fly()
	{
		if (m_flyBehavior)
		{
			m_flyBehavior();
		}
	}

	void Swim()
	{
		cout << "I'm swimming" << endl;
	}

	virtual void Display() const = 0;
	virtual ~Duck() = default;

private:
	FlyBehavior m_flyBehavior;
	DanceBehavior m_danceBehavior;
	QuackBehavior m_quackBehavior;
};

class MallardDuck : public Duck
{
public:
	void Display() const override
	{
		cout << "I'm mallard duck" << endl;
	}
};

class RedheadDuck : public Duck
{
public:
	void Display() const override
	{
		cout << "I'm redhead duck" << endl;
	}
};
class DecoyDuck : public Duck
{
public:
	void Display() const override
	{
		cout << "I'm decoy duck" << endl;
	}
};
class RubberDuck : public Duck
{
public:
	void Display() const override
	{
		cout << "I'm rubber duck" << endl;
	}
};

class ModelDuck : public Duck
{
public:
	void Display() const override
	{
		cout << "I'm model duck" << endl;
	}
};

void DrawDuck(Duck const& duck)
{
	duck.Display();
}

void SetStrategyBehavior(Duck& duck, const FlyBehavior& flyBehavior, const QuackBehavior& quackBehavior, const DanceBehavior& danceBehavior)
{
	duck.SetQuackBehavior(quackBehavior);
	duck.SetFlyBehavior(flyBehavior);
	duck.SetDanceBehavior(danceBehavior);
}

void PlayWithDuck(Duck& duck)
{
	DrawDuck(duck);
	duck.Quack();
	duck.Fly();
	duck.Dance();
	cout << endl;
}

int main()
{
	MallardDuck mallardDuck;
	SetStrategyBehavior(mallardDuck, FlyWithWings, DoubleQuackBehavior, ValseBehavior);
	PlayWithDuck(mallardDuck); 

	RedheadDuck redheadDuck;
	SetStrategyBehavior(redheadDuck, FlyWithWings, DoubleQuackBehavior, MinuetBehavior);
	PlayWithDuck(redheadDuck);

	RubberDuck rubberDuck;
	SetStrategyBehavior(rubberDuck, FlyNoWay, SqueakBehavior, DanceNoBehavior);
	PlayWithDuck(rubberDuck); 

	DecoyDuck decoyDuck;
	SetStrategyBehavior(decoyDuck, FlyNoWay, MuteQuackBehavior, DanceNoBehavior);
	PlayWithDuck(decoyDuck);

	ModelDuck modelDuck;
	SetStrategyBehavior(modelDuck, FlyNoWay, DoubleQuackBehavior, DanceNoBehavior);
	PlayWithDuck(modelDuck); 
	
    return 0;
}

