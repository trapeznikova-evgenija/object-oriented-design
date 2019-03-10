#pragma once

#include "IBeverage.h"
#include "Enums.h"

// Базовая реализация напитка, предоставляющая его описание
class CBeverage : public IBeverage
{
public:
	CBeverage(const std::string & description)
		:m_description(description)
	{}

	std::string GetDescription()const override final
	{
		return m_description;
	}
private:
	std::string m_description;
};

// Кофе
class CCoffee : public CBeverage
{
public:
	CCoffee(const std::string& description = "Coffee")
		:CBeverage(description)
	{}

	double GetCost() const override
	{
		return 60;
	}
};

// Капуччино
class CCapuccino : public CCoffee
{
public:
	CCapuccino(CoffeePortion portion = CoffeePortion::Standart)
		:CCoffee((portion == CoffeePortion::Standart) ? "Standart Capuccino" : "Double Capuccino"),
		m_portionName(portion)
	{}

	double GetCost() const override
	{
		switch (m_portionName)
		{
		case CoffeePortion::Standart:
			return 80;
			break;
		case CoffeePortion::Double:
			return 120;
			break;
		default:
			break;
		}
	}

private:
	CoffeePortion m_portionName;
};

// Латте
class CLatte : public CCoffee
{
public:
	CLatte(CoffeePortion portion = CoffeePortion::Standart)
		:CCoffee((portion == CoffeePortion::Standart) ? "Standart Latte" : "Double Latte"),
		m_portionName(portion)
	{}

	double GetCost() const override
	{
		switch (m_portionName)
		{
		case CoffeePortion::Standart:
			return 90;
			break;
		case CoffeePortion::Double:
			return 130;
			break;
		default:
			break;
		}
	}

private:
	CoffeePortion m_portionName;
};

// Чай
class CTea : public CBeverage
{
public:
	CTea(TeaSort sort = TeaSort::Oolong)
		:CBeverage(GetTeaDescription(sort))
	{}

	double GetCost() const override
	{
		return 30;
	}

private:
	std::string GetTeaDescription(TeaSort currSort)
	{
		switch (currSort)
		{
		case TeaSort::Puer:
			return "Puer";
		case TeaSort::Oolong:
			return "Oolong";
		case TeaSort::EarlGray:
			return "EarlGray";
		case TeaSort::Hibiscus:
			return "Hibiscus";
		default:
			return "Oolong";
		}
	}
};

// Молочный коктейль
class CMilkshake : public CBeverage
{
public:
	CMilkshake(MilkShakePortion portion = MilkShakePortion::Medium)
		:CBeverage(GetMilkshakeDescription(portion)),
		m_portionName(portion)
	{}

	double GetCost() const override
	{
		switch (m_portionName)
		{
		case MilkShakePortion::Small:
			return 50;
		case MilkShakePortion::Medium:
			return 60;
		case MilkShakePortion::Big:
			return 80;
		default:
			return 60;
		}
	}

private:
	std::string GetMilkshakeDescription(MilkShakePortion portion)
	{
		switch (portion)
		{
		case MilkShakePortion::Small:
			return "Small Milkshake";
		case MilkShakePortion::Medium:
			return "Medium Milkshake";
		case MilkShakePortion::Big:
			return "Big Milkshake";
		default:
			return "Medium Milkshake";
		}
	}

	MilkShakePortion m_portionName;
};