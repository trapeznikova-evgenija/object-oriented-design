// functional_style.cpp: определяет точку входа для консольного приложения.
//

#include "stdafx.h"
#include <functional>
#include <iostream>
#include <memory>
#include <string>

using namespace std;

using FlyBehavior = function<void()>;
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

FlyBehavior FlyWithWings()
{
	int countDepartures = 0;

	return [countDepartures]() mutable
	{
		countDepartures++;
		cout << "I'm flying with wings!!" << endl;
		cout << "Departure number " << countDepartures << endl;
	};
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
	Duck(const FlyBehavior& flyBehavior,
		const QuackBehavior& quackBehavior,
		const DanceBehavior& danceBehavior)
		: m_quackBehavior(quackBehavior),
		m_danceBehavior(danceBehavior)
	{
		SetFlyBehavior(flyBehavior);
	}

	void SetFlyBehavior(const FlyBehavior& behavior)
	{
		m_flyBehavior = behavior;
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
	MallardDuck()
		: Duck(FlyWithWings(), DoubleQuackBehavior, ValseBehavior)
	{
	}

	void Display() const override
	{
		cout << "I'm mallard duck" << endl;
	}
};

class RedheadDuck : public Duck
{
public:
	RedheadDuck()
		: Duck(FlyWithWings(), DoubleQuackBehavior, MinuetBehavior)
	{
	}

	void Display() const override
	{
		cout << "I'm redhead duck" << endl;
	}
};
class DecoyDuck : public Duck
{
public:
	DecoyDuck()
		: Duck(FlyNoWay, MuteQuackBehavior, DanceNoBehavior)
	{
	}

	void Display() const override
	{
		cout << "I'm decoy duck" << endl;
	}
};
class RubberDuck : public Duck
{
public:
	RubberDuck()
		: Duck(FlyNoWay, SqueakBehavior, DanceNoBehavior)
	{
	}

	void Display() const override
	{
		cout << "I'm rubber duck" << endl;
	}
};

class ModelDuck : public Duck
{
public:
	ModelDuck()
		: Duck(FlyNoWay, DoubleQuackBehavior, DanceNoBehavior)
	{
	}

	void Display() const override
	{
		cout << "I'm model duck" << endl;
	}
};

void DrawDuck(Duck const& duck)
{
	duck.Display();
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
	PlayWithDuck(mallardDuck); 

	RedheadDuck redheadDuck;
	PlayWithDuck(redheadDuck);
	PlayWithDuck(redheadDuck);

	RubberDuck rubberDuck;
	PlayWithDuck(rubberDuck); 

	DecoyDuck decoyDuck;
	PlayWithDuck(decoyDuck);

	ModelDuck modelDuck;
	PlayWithDuck(modelDuck); 
	modelDuck.SetFlyBehavior(FlyWithWings());
	PlayWithDuck(modelDuck);

    return 0;
}

